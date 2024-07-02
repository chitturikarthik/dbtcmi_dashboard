# Installing QIIME2 with mamba or conda
`wget https://data.qiime2.org/distro/core/qiime2-2023.5-py38-linux-conda.yml`
`mamba env create -n qiime2 --file qiime2-2023.5-py38-linux-conda.yml`
`mamba activate qiime2`

## Create a directory
`mkdir qiime2-tutorial`
`cd qiime2-tutorial`


## Importing data to qiime2
1. Create a tab-separated manifest file. Should contain 3 columns: sample-id; forward-absolute-filepath (for forward-reads) and reverse-absolute-filepath (for reverse-reads, in case of paired-end).
2. Manifest file maps sample identifiers to .fastq absolute filepaths & indicates the direction of reads in each .fastq file.
3. Download SingleEndFastqManifestPhred33V2: `wget -O "se-33-manifest" "https://data.qiime2.org/2023.5/tutorials/importing/se-33-manifest"`
4. `unzip -q se-33.zip`
5. `qiime tools import --type 'SampleData[SequencesWithQuality]' --input-path se-33-manifest --output-path single-end-demux.qza --input-format SingleEndFastqManifestPhred33V2`



## Get the files
*The sequences are already demultiplexed*

sample metadata file `wget -O "sample-metadata.tsv" "https://data.qiime2.org/2023.5/tutorials/fmt/sample_metadata.tsv"`
one set of demultiplexed sequence `wget -O "fmt-tutorial-demux-1.qza" "https://data.qiime2.org/2023.5/tutorials/fmt/fmt-tutorial-demux-1-10p.qza"`
second set of demultiplexed sequence `wget -O "fmt-tutorial-demux-2.qza" "https://data.qiime2.org/2023.5/tutorials/fmt/fmt-tutorial-demux-2-10p.qza"`

Time taken for downloading = 3 mins



## qiime demux-summarize

For 1st set `qiime demux summarize --i-data fmt-tutorial-demux-1.qza --o-visualization demux-summary-1.qzv`   #73 samples
For 2nd det `qiime demux summarize --i-data fmt-tutorial-demux-2.qza --o-visualization demux-summary-2.qzv`   #48 samples

*The output file shows per-sample sequence counts and statistics such as mean, median, minimum & maximum*
Time taken for each = **25 seconds**



## qiime dada2 denoise-single: perfoming quality control on the demultiplexed sequence
*Run denoise-single command individually on each set of demultiplexed sequences*
To remove low quality regions of the sequences _Parameters to check: **--p-trim-left m** (trims off the first m bases of each sequence) & **--p-trunc-len n** (truncates each sequence at position n)_ 
Should be choosen based on the interactive quality plot from **demux_summary-1.qzv** file

1. For 1st set `qiime dada2 denoise-single --p-trim-left 13 --p-trunc-len 150 --i-demultiplexed-seqs fmt-tutorial-demux-1.qza --o-representative-sequences rep-seqs-1.qza --o-table table-1.qza --o-denoising-stats stats-1.qza`
   Time taken = **2mins.53sec**

2. For 2nd set `qiime dada2 denoise-single --p-trim-left 13 --p-trunc-len 150 --i-demultiplexed-seqs fmt-tutorial-demux-2.qza --o-representative-sequences rep-seqs-2.qza --o-table table-2.qza --o-denoising-stats stats-2.qza`
   Time taken = **1min.18sec**

Results will produce FeatureTable[Frequency] & FeatureData[Sequence] QIIME2 artifact.
**FeatureTable[Frequency]**: contains count or frequencies of each unique sequence in each sample in the dataset (ASV table)
**FeatureData[Sequence]**: maps feature identifiers in the FeatureTable to the sequences they represent (Representative sequences file).



## qiime metadata tabulate
*Run to visualize basic statistics about the denoising process*
1. For 1st set `qiime metadata tabulate --m-input-file stats-1.qza --o-visualization denoising-stats-1.qzv`
   Time taken = **0m10.57sec**

2. For 2nd set `qiime metadata tabulate --m-input-file stats-2.qza --o-visualization denoising-stats-2.qzv`
   Time taken = **0m10.22sec**

For each sample it will show the following: **input, filtered, percentage of input passed filter, denoised, non-chimeric, percentage of input non-chimeric**



## qiime feature-table merge
*Merge two FeatureTable[Frequency] artifacts*
`qiime feature-table merge --i-tables table-1.qza --i-tables table-2.qza --o-merged-table table.qza`
Time taken = **0m9.89sec**

## qiime feature-table merge-seqs
*Merge two FeatureData[Sequence] artifacts*
`qiime feature-table merge-seqs --i-data rep-seqs-1.qza --i-data rep-seqs-2.qza --o-merged-data rep-seqs.qza`
Time taken = **0m10.76sec**



## qiime feature-table summarize
*Shows information about how many sequences are associated with each sample and with each feature, histograms of those distributions, & related summary statistics*
`qiime feature-table summarize --i-table table.qza --o-visualization table.qzv --m-sample-metadata-file sample-metadata.tsv`
Time taken = **0m11.96sec**


## qiime feature-table tabulate-seqs
*Provides mapping of feature IDs to sequences, and links to BLAST each sequence against the NCBI nucleotide database.* 
`qiime feature-table tabulate-seqs --i-data rep-seqs.qza --o-visualization rep-seqs.qzv`
Time taken = **0m10.56sec**




# TAXONOMY ANALYSIS
## qiime feature-classifier classify-sklearn
*assign taxonomy to the sequences in FeatureData[Sequence] QIIME 2 artifact*
1. Download pre-trained Naive Bayes classifier of silva: `wget -O "silva-138-99-nb-classifier.qza" "https://data.qiime2.org/2023.5/common/silva-138-99-nb-classifier.qza" `
2. `qiime feature-classifier classify-sklearn --i-classifier silva-138-99-nb-classifier.qza --i-reads rep-seqs.qza --o-classification taxonomy.qza`
   Time taken = **42 mins** 

3. `qiime metadata tabulate --m-input-file taxonomy.qza --o-visualization taxonomy.qzv`
   Time taken = **0m21.72sec**
Provides an output showing taxonomic composition for each Feature/ASV & corresponding confidence.


## qiime taxa barplot
*To visualize taxonomic composition with interactive bar plots*
4. `qiime taxa barplot --i-table table.qza --i-taxonomy taxonomy.qza --m-metadata-file sample-metadata.tsv --o-visualization taxa-bar-plots.qzv`




# GENERATE A PHYLOGENETIC TREE
## qiime phylogeny align-to-tree-mafft-fasttree
`qiime phylogeny align-to-tree-mafft-fasttree --i-sequences rep-seqs.qza --o-alignment aligned-rep-seqs.qza --o-masked-alignment masked-aligned-rep-seqs.qza --o-tree unrooted-tree.qza --o-rooted-tree rooted-tree.qza`
 Time taken = **0m17.63sec**


# ALPHA AND BETA DIVERSITY ANALYSIS
## qiime diversity core-metrics-phylogenetic
*rarefies a FeatureTable[Frequency] to a user-specified depth*
_Parameter to check: **--p-sampling-depth**_ : even sampling (i.e. rarefaction) depth
Should be chosen based on information presented in the table.qzv file so that the value is high & retains more sequences per sample while excluding as few samples as possible 
1. `qiime diversity core-metrics-phylogenetic --i-phylogeny rooted-tree.qza --i-table table.qza --p-sampling-depth 100 --m-metadata-file sample-metadata.tsv --output-dir core-metrics-results`
   Time taken = **0m14.63sec**

Create an output directory core-metrics-results



## test for associations between categorical metadata columns and alpha diversity data
## qiime diversity alpha-group-significance:  faith-pd-group
*a qualitative measure of community richness that incorporates phylogenetic relationships between the features*
2. `qiime diversity alpha-group-significance --i-alpha-diversity core-metrics-results/faith_pd_vector.qza --m-metadata-file sample-metadata.tsv --o-visualization core-metrics-results/faith-pd-group-significance.qzv`
   Time taken = **0m10.48sec**


## qiime diversity alpha-group-significance: evenness group
*a measure of community evenness*
3. `qiime diversity alpha-group-significance --i-alpha-diversity core-metrics-results/evenness_vector.qza --m-metadata-file sample-metadata.tsv --o-visualization core-metrics-results/evenness-group-significance.qzv`
   Time taken = **0m10.38sec**


**no continuous sample metadata columns are correlated with alpha diversity**



## analyze sample composition in the context of categorical metadata using beta-group-significance
## qiime diversity beta-group-significance
*will test whether distances between samples within a group, such as samples from the same sample-type are more similar to each other then they are to samples from the other groups*
*perform pairwise tests that will allow you to determine which specific pairs of groups differ from one another* 
For column: sample-type
4. `qiime diversity beta-group-significance --i-distance-matrix core-metrics-results/unweighted_unifrac_distance_matrix.qza --m-metadata-file sample-metadata.tsv --m-metadata-column sample-type --o-visualization core-metrics-results/unweighted-unifrac-sample-type-significance.qzv --p-pairwise`
   Time taken = **0m11.20sec**

For column: treatment-group
5. `qiime diversity beta-group-significance --i-distance-matrix core-metrics-results/unweighted_unifrac_distance_matrix.qza --m-metadata-file sample-metadata.tsv --m-metadata-column treatment-group --o-visualization core-metrics-results/unweighted-unifrac-treatment-group-significance.qzv --p-pairwise`
   Time taken = **0m11.79sec**

For column: administration-route
6. `qiime diversity beta-group-significance --i-distance-matrix core-metrics-results/unweighted_unifrac_distance_matrix.qza --m-metadata-file sample-metadata.tsv --m-metadata-column administration-route --o-visualization core-metrics-results/unweighted-unifrac-administration-route-significance.qzv --p-pairwise`
   Time taken = **0m10.79sec**


## qiime emperor plot
*to explore microbial community composition by principal coordinates (PCoA) plots in the context of sample metadata*
*--p-custom-axes which is very useful for exploring time series data*
*to explore how these samples changed over time*
Unweighted unifrac
6. `qiime emperor plot --i-pcoa core-metrics-results/unweighted_unifrac_pcoa_results.qza --m-metadata-file sample-metadata.tsv --p-custom-axes week --o-visualization core-metrics-results/unweighted-unifrac-emperor-week.qzv`
   Time taken = **0m10.27sec**

Bray curtis
7. `qiime emperor plot --i-pcoa core-metrics-results/bray_curtis_pcoa_results.qza --m-metadata-file sample-metadata.tsv --p-custom-axes week --o-visualization core-metrics-results/bray-curtis-emperor-week.qzv`
   Time taken = **0m10.85sec**





# ALPHA RAREFACTION PLOTTING
*explore alpha diversity as a function of sampling depth*
*computes one or more alpha diversity metrics at multiple sampling depths*
*generates 10 rarefied tables at each sampling depth step & computes diversity metrics for all samples in the tables*
*--p-iterations controls number of iterations*
*Plots average diversity values for each sample at each even sampling depth and groups samples based on metadata*
_parameter to check: **--p-max-depth**_ (should be choosen from table.qzv - value that is somewhere around the median frequency) 

8. `qiime diversity alpha-rarefaction   --i-table table.qza   --i-phylogeny rooted-tree.qza   --p-max-depth 351   --m-metadata-file sample-metadata.tsv   --o-visualization alpha-rarefaction.qzv`
   Time taken = **55 secs**

Produce two plots: 
a.  top plot is an alpha rarefaction plot to determine if the richness of the samples has been fully observed or sequenced.
b.  bottom plot is important when grouping samples by metadata. It illustrates the number of samples that remain in each group when the feature table is rarefied to each sampling depth.
