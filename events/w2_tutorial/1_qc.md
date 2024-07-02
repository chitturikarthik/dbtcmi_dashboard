# Bacterial genome analysis - Reference based (DAY-1)
------------
Raw reads QC- FastQC
------

1.  Navigate to bgap directory and activate qc
    ```bash             
    $ cd Desktop/bgap
    $ mamba deactivate
    $ mamba activate qc
    ```   
    
3.  Open FastQC GUI. Analyze and save the reports
    ```bash
    (qc)$ fastqc
    ```   
    
4.  See the Basic statistics, Per base quality, Sequence length distribution, Overrepresented sequences and Adapter content sections

### BBDuk

1.  Run bbduk. Copied adapters file
    ```bash
    (qc)$ mkdir bb_out
    (qc)$ cd bb_out
    (qc)$ bbduk.sh in1=../reads/a45_R1.fastq in2=../reads/a45_R2.fastq out1=a45_R1.fastq out2=a45_R2.fastq ref=adapters.fa k=23 mink=7 ktrim=r hdist=1 qtrim=r trimq=20 minlen=100 tpe tbo
    ```    
    
2.  Result
    
    > Input: 1741880 reads 436749684 bases.  
    > QTrimmed: 1522186 reads (87.39%) 103642774 bases (23.73%)  
    > KTrimmed: 376743 reads (21.63%) 13100754 bases (3.00%)  
    > Trimmed by overlap: 8692 reads (0.50%) 88862 bases (0.02%)  
    > Total Removed: 170588 reads (9.79%) 116832390 bases (26.75%)  
    > Result: 1571292 reads (90.21%) 319917294 bases (73.25%)
    
3.  Open FastQC GUI. Analyze and save the reports
    ```bash 
    (qc)$ fastqc
    ```     
### Trimmomatic

1.  Run trimmomatic. Using BBDuk adapters file
    ```bash   
    (qc)$ mkdir trim_out
    (qc)$ cd trim_out
    (qc)$ trimmomatic PE -phred33 ../reads/a45_R1.fastq ../reads/a45_R2.fastq a45_R1_paired.fq.gz a45_R1_unpaired.fq.gz a45_R2_paired.fq.gz a45_R2_unpaired.fq.gz ILLUMINACLIP:../adapters.fa:2:30:10 SLIDINGWINDOW:4:20 MINLEN:100
    ```      
3.  Input Read Pairs: 870940 Both Surviving: 599798 (68.87%) Forward Only Surviving: 160897 (18.47%) Reverse Only Surviving: 28249 (3.24%) Dropped: 81996 (9.41%)
4.  Open FastQC GUI. Analyze and save the reports
     ```bash   
     (qc)$ fastqc
     ```    
     
# Mapping to Reference Genome

After filtering the raw reads, you can choose either of the following methods depending on the availability of reference genome or intra-species variations.  
Basically, if you have a reference genome and do not expect much variation from it, then the reads are mapped to the reference. Else, de novo assembly is preferred.

### Mapping to a Reference

1.  Index the reference sequence
    ```bash
    (qc)$ mkdir mapping
    (qc)$ cd mapping
    (qc)$ mamba deactivate
    (qc)$ mamba activate mappers
    (qc)$ cp ../resources/NZ_CP053256.1_A45_Chr.fasta ./Ref_A45_chr.fasta
    (qc)$ bwa index -a is Ref_A45_chr.fasta
    ```  
    
2.  Align Reads separately
    ```bash
    (qc)$ cp ../bb_out/*.fastq ./
    (qc)$ bwa aln -t 12 Ref_A45_chr.fasta a45_R1.fastq > a45_R1.sai
    (qc)$ bwa aln -t 12 Ref_A45_chr.fasta a45_R2.fastq > a45_R2.sai
    ``` 
    
3.  Create SAM file and convert it to BAM
    ```bash
    (qc)$ bwa sampe Ref_A45_chr.fasta a45_R1.sai a45_R2.sai a45_R1.fastq a45_R2.fastq > a45_aln.sam
    (qc)$ samtools view -S a45_aln.sam -b -o a45_aln.bam
    ```
    
4.  Sort and index BAM file
    ```bash
    (qc)$ samtools sort a45_aln.bam -o a45_sorted.bam
    (qc)$ samtools index a45_sorted.bam
     ``` 
    
5. Creating a consensus
    ```bash
    (qc)$ samtools mpileup -uf Ref_A45_chr.fasta a45_sorted.bam | bcftools call -c | vcfutils.pl vcf2fq > a45_consensus.fq
    ``` 
    
6. Convert to fasta & change the identifier
    ```bash
    (qc)$ mamba deactivate
    (base)$ mamba activate emboss
    (emboss)$ seqret -osformat fasta a45_consensus.fq -out2 a45_consensus.fa
    ```  
    
7. Exporting unmapped reads (Optional)
    ``` bash
    (emboss)$ mamba deactivate
    (base)$ mamba activate bam2fastq
    (bam2fastq)$ bam2fastq --no-aligned --force --strict -o a45_unmapped#.fq a45_sorted.bam
    ```

8.  Check the rRNA Genes (Optional)
    ```bash
    (bam2fastq)$ mamba deactivate
    (base)$ mamba activate barrnap
    (barrnap)$ barrnap -o cons_rrna.fa < ../mappers/a45_consensus.fa > cons_rrna.gff
    ```     
    
9.  Close the gap
    ```bash
    (bam2fastq)$ mamba deactivate
    (base)$ mamba activate filler
    (filler)$ barrnap -o cons_rrna.fa < ../mapping/a45_consensus.fa > cons_rrna.gff
    ```
