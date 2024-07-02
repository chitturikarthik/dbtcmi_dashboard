# de novo Assembly (DAY-2)

### SPAdes

1.  Spades  
    ```bash
    (base)$ mkdir denovo
    (base)$ cd denovo
    (base)$ mkdir spades
    (base)$ mamba activate assembler
    (assembler)$ spades.py --careful --pe1-1 bb_out/a45_R1.fastq --pe1-2 bb_out/a45_R2.fastq -o spades/ --cov-cutoff auto -t 6
    ```    
    > Started at 11:37 pm. Ended at 11:43 pm.  
    > With 4 threads: 11:49 pm to 11.59 pm  
    > With 6 threads: 9m:54s
    
3.  Results
   
    Check for insert size in the log file & number of contigs/scaffolds in the fasta file.
    ```bash
    (assembler)$ grep -i 'insert' spades.log
    (assembler)$ grep -i '>' scaffolds.fasta -c
    ```  
    
5.  Barrnap (Optional)
    ```bash
    $ mkdir barrnap_out
    $ cd barrnap_out
    $ barrnap -o spades_rrna.fa < ../spades/scaffolds.fasta > spades_rrna.gff
    ```    
   


## Alternatives tools and step

1.  ### IDBA
    ```bash
    $ fq2fa --merge --filter ../bb_out/a45_R1.fastq ../bb_out/a45_R2.fastq a45_reads.fa
    $ idba_ud -r a45_reads.fa -o ./
    ```   
    
2.  ### Velvet
    ```bash
    $ VelvetOptimiser.pl -s 79 -e 159 -f '-shortPaired -fastq -separate ../bb_out/a45_R1.fastq ../bb_out/a45_R2.fastq' -t 12 -d ./ -v
    ```    
    
3.  ### Unicycler
    ```bash
    $ unicycler -1 ../bb_out/a45_R1.fastq -2 ../bb_out/a45_R2.fastq -o ./ -t 6
    ```
    
# Steps after De-novo Assembly
## Contig Management
### MeDuSa

1.  Note If there are any colons in the header of fasta
    ```bash
    (base)$ sed -i 's/:/_/g' scaffolds.fasta
    ```  
    
2.  Make a new directory - medusa\_out and Copy the scaffolds file in medusa\_out directory
    ```bash
    (base)$ mkdir medusa_out
    (base)$ cp spades/scaffolds.fasta medusa_out
    ```  
    
3.  Inside medusa\_out directory create a new folder Ref and download chromosome & plasmid reference data from ([https://www.ncbi.nlm.nih.gov/genome/169?genome\_assembly\_id=901025](https://www.ncbi.nlm.nih.gov/genome/169?genome_assembly_id=901025)) and Merge both files, save it as full genome.  
    **Note: keep only merged files inside Ref directory**
    ```bash
    (base)$ cd medusa_out
    (base)$ mkdir Ref
    (base)$ cat Ref_A45_chr.fasta Ref_A45_p.fasta > Ref/Ref_A45_full.fasta
    ``` 
    
4. Copy the scaffolds file to current directory (scaffolds.fasta from the spades directory)  
    Create new environment and install medusa
    ```bash
    (base)$ mamba deactivate
    $ mamba activate scaffolder
    ```   
    
5. Run the medusa command
    ```bash
    (scaffolder)$ medusa -d -f Ref/ -i scaffolds.fasta -random 10 -w2 -v
    ```  
    > If you face cPickle error  
    > open python file and Change cPickle to pickle in Home/mambaforge/envs/medusa/share/medusa-1.6-2/script/netcon\_mummer.py

### Mauve

> Mauve  
> Before proceeding with mauve you have to check how many no. of “N” “n” (gaps) are there in “medusa_out/scaffolds.fastaScaffold.fasta” file.

1.  Activate mauve env.
   
    ```bash
    (scaffolder)$ cd ../
    (scaffolder)$ mamba deactivate
    (scaffolder)$ mamba activate mauve
    ```
    
2.  Run Mauve
    
    ```bash
    (mauve)$ mkdir mauve_out
    (mauve)$ Mauve
    (mauve)$ cd mauve_out
    ```
    
    > This has Graphical UI  
    > Do Progressive alignemnt  
    > Then Reorder the contigs  
    > tools > move contigs > choose output folder (choose mauve\_out folder where output will save) > add sequence(medusa\_out/Ref\_A45\_full.fasta this is combined file plasmid and chromosome) and again add sequence(medusa\_out/scaffolds.fastaScaffold.fasta) > start
    

### GapCloser

1.  Activate filler env.
    ```bash
    (mauve)$ cd ../
    (mauve)$ mamba deactivate 
    (base)$ mamba activate fillers
    ```  
    
2.  Run filler (soapdenovo2-gapcloser)
    
    > to run gapcloser you need to create config file with some sequence parameters like raw reads length  
    > max\_read\_lenth (select from bb\_out result html file) and avg\_ins (insert size: select from spades.log you can grep “Insert” from spades.log file)
    
    a45\_GC.config file
    ```bash
    [LIB]
    name=a45
    avg_ins=452
    reverse_seq=0
    asm_flags=4
    rank=1
    pair_num_cutoff=3
    map_len=32
    q1=bb_out/a45_R1.fastq
    q2=bb_out/a45_R2.fastq
    ```
    ```bash
    (fillers)$ mkdir filler_out
    (fillers)$ GapCloser -a mauve_out/alignment2/scaffolds.fastaScaffold.fasta -b a45_GC.config -o filler_out/a45_GC.fasta -t 6
    ``` 
    
    OR (If you are skipping mauve then you can use medusa\_out as input)
    

### Use Pilon if there is still gaps (N) in Gapcloser result

1.  Before running Pilon we have to index the fasta file and reads
    ```bash
    (fillers)$ mkdir pilon_out
    (fillers)$ cd pilon_out
    (fillers)$ mamba deactivate
    (base)$ mamba activate mappers
    ```  
    
2.  Index the genome
    ```bash
    (mappers)$ bowtie2-build ../filler/a45_GC.fasta a45
    ```   
    
3.  Align reads to genome (5 mins with 12 cores)
    ```bash
    (mappers)$ bowtie2 -x a45 -1 ../bb_out/a45_R1.fastq -2 ../bb_out/a45_R2.fastq -S reads_on_assembly.sam -p 12
    ```
    #####  Convert SAM to BAM, sort and index
    
    ```bash
    (mappers)$ samtools view reads_on_assembly.sam -b -o reads_on_assembly.bam
    (mappers)$ samtools sort reads_on_assembly.bam -o reads_on_assembly_sorted.bam
    (mappers)$ samtools index reads_on_assembly_sorted.bam
    ``` 
    
4.  Activate pilon
    ```bash
    (mappers)$ mamba deactivate
    (mappers)$ mamba activate pilon
    (pilon)$ pilon --genome ../filler_out/a45_GC.fasta --frags reads_on_assembly_sorted.bam
    ```   
    
    If there is a memory error open the following file
    
    > /home/anwesh/mambaforge/envs/pilon/share/pilon-1.24-0  
    > And increase the max memory option from
        default_jvm_mem_opts = ['-Xms512m', '-Xmx1g'] to whatever your RAM has (I increase it from 1g to 4g)
        default_jvm_mem_opts = ['-Xms512m', '-Xmx4g']
        
    

### BUSCO (for qc)

1.  Activate busco env.
    ```bash  
    (pilon)$ cd ../
    (pilon)$mamba deactivate
    (base)$ mamba activate busco
    (busco)$ mamba install -c conda-forge -c bioconda busco=5.4*
    (busco)$ mkdir busco_qc
    ```  
    
2.  Run BUSCO
    ```bash
    (busco)$ busco -m genome -i filler_out/a45_GC.fasta -o busco_qc/a45 --auto-lineage-prok -c 10
    OR
    (busco)$ busco -m genome -i pilon_out/pilon.fasta -o a45 --auto-lineage-prok -c 10
    ```   
    
### CheckM

1.  Activate Checkm
    ```bash
    (busco)$ mamba deactivate
    (busco)$ mamba activate checkm
    (checkm)$ mkdir checkm_out
    (checkm)$ cd checkm_out
    ```    
>**_Note: Copy spades.fasta pilon.fasta or gapcloser.fasta and a45\_GC.fasta into a new directory - genomes  
Create new directory checkm\_out and navigate into it_**

2. Create new directory and copy assembled genome

    ```bash
    (checkm)$ mkdir genomes
    (checkm)$ cp ../filler_out/a45_GC.fasta genomes/
    (checkm)$ cp ../spades/scaffolds.fasta genomes/
    (checkm)$ cp ../medusa_out/scaffolds.fastaScaffold.fasta genomes/
    ```   

3. Run checkm
   ```bash
   (checkm)$ checkm lineage_wf -x fasta ../genomes/ ./ -r -f ./results.txt -t 12
   ```  
    
    > If you face FileNotFoundError: \[Errno 2\] No such file or directory: ‘/home/dbt-cmi/.checkm/hmms/phylo.hmm’ then download reference data ([https://github.com/Ecogenomics/CheckM/wiki/Installation#how-to-install-checkm](https://github.com/Ecogenomics/CheckM/wiki/Installation#how-to-install-checkm)) and extract it in path “/home/dbt-cmi/.checkm/”  
    > Read Installation and download Required reference data ([https://data.ace.uq.edu.au/public/CheckM\_databases](https://data.ace.uq.edu.au/public/CheckM_databases))
    
5.  Run and Check asssembly stats
    ```bash
    (checkm)$ assembly-stats ../genomes/*.fasta > assembly_stats.txt
    ```

### Split the assembly into Chr and plasmid

### RAST
### Online tool


# Genome Annotation (Day-2)
### Prokka
1. Activate prokka env.
    ```bash
   (base)$ mamba activate prokka
    ```
    > Download GBK files as we have a reference genome.
    https://www.ncbi.nlm.nih.gov/nuccore/NZ_CP053256
    
2. Make a directory and run prokka
    ```bash
    (prokka)$ mkdir prokka_out
    (prokka)$ cd prokka_out
    (prokka)$ prokka --outdir prokka_out/a45 --prefix a45 genomes/pilon.fasta
    (prokka)$ mamba deactivate
    ```
    > pilon.fasta is a genome sequence
    Download reference genomoes and run prokka on all of them

### Roary
1. Activate Roary env.
   >Run roary if you have more then one genome, roary takes multiple gff file as input of prokka.
   if you have only one genome then skip PAN genome (roray) and procced to next step
    
    ```bash
    (base)$  mamba activate roary
    (roary)$ cd ../
    (roary)$ mamba activate roary
    ```

3. Make a new directory raory and navigate into it
  Run roary 
    ```bash
    (roary)$ mkdir roary_out
    (roary)$ roary prokka_out/*/*.gff -e -n -r -v -f tenRefs
    ```
    >If Error: not found File::Find::Rule
    
    ```bash
    (roary)$ cpan File::Find::Rule
    ```
    
    >FriPan (https://github.com/drpowell/FriPan)
    Change the server module in server.sh, as suggested in this site
    https://stackoverflow.com/questions/17351016/set-up-python-simplehttpserver-on-windows
    Copy roray output to FriPan root and rename it to filename.roary

### Mafft 
1. Create Mafft env. and install
    ```bash
    (roary)$ mamba deactivate
    (base)$ mamba create -n phylogeny -y
    (base)$ mamba activate phylogeny
    (phylogeny)$ mamba install -c bioconda mafft
    ```
2. Run MAFFT
    ```bash
    (phylogeny)$ mafft --maxiterate 100 --reorder --thread 10 16S_a45-Ref-Out.fasta > 16S_a45-Ref-Out_aln.fasta
    ```
    >RaxML GUI - https://github.com/AntonelliLab/raxmlGUI/releases/latest/download/raxmlGUI-2.0.10.AppImage
    raxmlHPC-PTHREADS-SSE3 -T 10 -f a -x 288426 -p 288426 -N 100 -m GTRGAMMA -O -o H_acinonychis -n 16S -s 16S_BSE-Ref-Out_aln_modified.fasta 

### TYGS
### Dotplot with D-Genies
### antiSMASH
### Circos
1. Create Circos env. and install
    ```bash
    (phylogeny)$ mamba deactivate
    (base)$ mamba create -n circos -y
    (base)$ mamba activate circos
    (circos)$ mamba install -c bioconda circos
    ```
### KBase
    