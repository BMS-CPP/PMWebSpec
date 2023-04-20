-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 04:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbstruct_ci_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `dsflag`
--

CREATE TABLE `dsflag` (
  `FlagNum` int(11) DEFAULT NULL,
  `FlagCom` text DEFAULT NULL,
  `FlagNotes` text DEFAULT NULL,
  `SpecType` varchar(30) DEFAULT NULL,
  `required` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dsflag`
--

INSERT INTO `dsflag` (`FlagNum`, `FlagCom`, `FlagNotes`, `SpecType`, `required`) VALUES
(1, 'No Dosing Records, all PK samples flagged; missing sample date and time or concentration; error in dosing date/time', 'This can be due to dosing/sampling date issue; for error in dose date/time, flag-related PK samples with same flag number; negative AFRELTM when study day > 0', 'PPK-standard', 1),
(2, 'Post first dose LLOQ or BLQ', NULL, 'PPK-standard', 1),
(3, 'Day 1 pre-dose samples', NULL, 'PPK-standard', 1),
(4, 'Duplicate sample with same concentration at same AFRELTM (set up for NCA analysis)', NULL, 'PPK-standard', 0),
(5, 'Concentration value outliers', 'Confirm flag criteria with pharmacometricians', 'PPK-standard', 0),
(6, 'Duplicate samples with different concentrations', NULL, 'PPK-standard', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dsstruct`
--

CREATE TABLE `dsstruct` (
  `varorder` int(11) NOT NULL,
  `var_name` char(10) NOT NULL,
  `var_label` char(50) NOT NULL,
  `units` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `round` varchar(20) DEFAULT NULL,
  `missVal` varchar(20) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `source` text DEFAULT NULL,
  `requiredFlag` int(11) DEFAULT NULL,
  `SpecType` varchar(30) DEFAULT NULL,
  `nameChange` int(11) DEFAULT NULL,
  `labelChange` int(11) DEFAULT NULL,
  `unitChange` int(11) DEFAULT NULL,
  `typeChange` int(11) DEFAULT NULL,
  `roundChange` int(11) DEFAULT NULL,
  `missValChange` int(11) DEFAULT NULL,
  `noteChange` int(11) DEFAULT NULL,
  `sourceChange` int(11) DEFAULT NULL,
  `erflag` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dsstruct`
--

INSERT INTO `dsstruct` (`varorder`, `var_name`, `var_label`, `units`, `type`, `round`, `missVal`, `note`, `source`, `requiredFlag`, `SpecType`, `nameChange`, `labelChange`, `unitChange`, `typeChange`, `roundChange`, `missValChange`, `noteChange`, `sourceChange`, `erflag`) VALUES
(1, 'PROJID', 'Project Identifier', 'NA', 'Char', 'NA', 'blank', 'Text representing protocol or compound name', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(2, 'PROJIDN', 'Project Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of PROJID', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(3, 'STUDYID', 'Study Identifier', 'NA', 'Char', 'NA', 'blank', 'Must be identical to the ADSL variable', NULL, 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(4, 'STUDYIDN', 'Study Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of STUDYID', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(5, 'PART', 'Part of the Study', 'NA', 'Num', 'NA', '.', 'As defined per protocol. Required when study has more than one part, e.g., there can be a dose-escalation part (part A) and dose-evaluation part (part B). In SDTM it is mapped in STUDYID by some sponsor companies.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(6, 'EXTEN', 'Extension of the Core Study', 'NA', 'Num', 'NA', '.', 'As defined per protocol. Required if study has an extension.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(7, 'SUBJTYP', 'Subject Type', 'NA', 'Char', 'NA', 'blank', 'For first-in-human studies, the value can be \"Healthy volunteers\".', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(8, 'SUBJTYPN', 'Subject Type (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of SUBJTYP', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(9, 'USUBJID', 'Unique Subject Identifier', 'NA', 'Char', 'NA', 'blank', 'PC.USUBJID. Must be identical to the ADSL variable', NULL, 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(10, 'USUBJIDN', 'Unique Subject Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of USUBJID.', NULL, 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(11, 'SUBJID', 'Subject Identifier for the Study', 'NA', 'Char', 'NA', 'blank', 'DM.SUBJID or ADSL.SUBJID.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(12, 'SUBJIDN', 'Subject Identifier for the Study (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of SUBJID', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(13, 'SITEID', 'Study Site Identifier', 'NA', 'Char', 'NA', 'blank', 'DM.SITEID or ADSL.SITEID', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(14, 'SITEIDN', 'Study Site Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of SITEID', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(15, 'RECSEQS', 'Record Sequence Number Within a Subject', 'NA', 'Num', 'NA', '.', 'The dataset should be ordered by subject, time, event, dependent variable name and then the sequence should be derived for each subject. Sequential values should start with 1 on the first row for each subject and incrementing by 1 for each subsequent row. It is often used for convenience purposes and merging of PK and PD dataset. It can also be useful for the tracking of outlier exclusion, since the variable is preserved from the original to the final dataset.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(16, 'RECSEQ', 'Record Sequence', 'NA', 'Num', 'NA', '.', 'Derived sequence for the whole dataset. Sequential values should start with 1 on the first non-header row of the data file (i.e., skipping the variable names) and incrementing by 1 for each subsequent row. These are basically row numbers. It is often used for convenience purposes and merging of PK and PD dataset. It can also be useful for the tracking of outlier exclusion, since the', NULL, 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(17, 'AVISIT', 'Analysis Visit', 'NA', 'Char', 'NA', 'blank', 'The analysis visit description; required if an analysis is done by nominal, assigned or analysis visit. AVISIT may contain the visit names as observed (i.e., from SDTM VISIT), derived visit names, time window names, conceptual descriptions (such as Average, Endpoint, etc.), or a combination of any of these. AVISIT is a derived field and does not have to map to VISIT from the SDTM. AVISIT represents the analysis visit of the record, but it does not mean that the record was analyzed. There are often multiple records for the same subject and parameter that have the same value of AVISIT. ANLzzFL and other variables may be needed to identify the records selected for any given analysis. See Section 3.3.8 of the ADaM Implementation Guide for information about flag variables. AVISIT should be unique for a given analysis visit window. In the event, that a record does not fall within any predefined analysis timepoint window, AVISIT can be populated in any way that the producer chooses to indicate this fact (i.e., blank or “Not Windowed”). The way that AVISIT is calculated, including the variables used in its derivation, should be indicated in the variable metadata for AVISIT. The values and the rules for deriving AVISIT may be different for different parameters within the same dataset. Values of AVISIT are producer-defined and are often directly usable in Clinical Study Report displays.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(18, 'AVISITN', 'Analysis Visit (N)', 'NA', 'Num', 'NA', '.', 'A numeric representation of AVISIT. Since study visits are usually defined by certain timepoints, defining AVISITN so that it represents the timepoint associated with the visit can facilitate plotting and interpretation of the values. Alternatively, AVISITN may be a protocol visit number, a cycle number, an analysis visit number, or any other number logically related to AVISIT or useful for sorting that is needed for analysis. Within a parameter, there is a one-to-one mapping between AVISITN and AVISIT so that AVISITN has the same value for each distinct AVISIT. (Best practice would dictate that the mapping would be one-to-one within a study, but that is not an ADaM requirement.) In the event that a record does not fall within any predefined analysis timepoint window, AVISITN can be populated in any way that the producer chooses to indicate this fact (e.g., may be null). Values of AVISITN are producer-defined.)', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(19, 'VISIT', 'Visit', 'NA', 'Char', 'NA', 'blank', 'Clinic visit captured in SDTM domains EX or PC and variable VISIT', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(20, 'VISITNUM', 'Visit (N)', 'NA', 'Num', 'NA', '.', 'Clinic visit captured in SDTM domains EX or PC and variable VISITNUM', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(21, 'AFRELTM', 'Actual Rel Time From First Dose', 'hr', 'Num', '0.01', '.', 'Rel: Relative. Actual elapsed time (for sample point or start of sampling interval) from first dose to study treatment. Could be negative. We recommend that variables ending in RELTM be excluded from the TM timing format. Derived from (ADTM of the current event/record of the subject) - (ADTM of the first dosing event/record of the subject)', NULL, 1, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(22, 'TPTREF', 'Time Point Reference', 'NA', 'Char', 'NA', 'blank', 'Description of reference dose, e.g. first dose in the period, last dose in the period or anything in between.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(23, 'APRELTM', 'Actual Rel Time From Previous Dose', 'hr', 'Num', '0.01', '.', 'Rel: Relative. Derived from (Analysis date/time of the current event/record of the subject) - (Analysis date/time of the previous dosing event/record of the subject).', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(24, 'NFRELTM', 'Nominal Rel Time From First Dose', 'hr', 'Num', '0.1', '.', 'Rel: Relative. Planned elapsed time (for sample point or start of sampling interval) from first exposure to study treatment. We recommend that variables ending in RELTM be excluded from the TM timing format. For PK it will be in PC domain', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(25, 'NPRELTM', 'Nominal Rel Time From Previous Dose', 'hr', 'Num', '0.1', '.', 'Rel: Relative. For PK it can be derived from NRRELTM or equivant variable that has nominal time in PC domain', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(26, 'ATPT', 'Planned Time Point Name', 'NA', 'Char', 'NA', 'blank', 'Text description of the planned/protocol time for the specimen collection. Taken from PC.PCTPT.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(27, 'ATPTN', 'Planned Time Point Number', 'NA', 'Num', 'NA', '.', 'PC.PCTPTNUM, numerical representation for PCTPT.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(28, 'ADT', 'Analysis Date', 'NA', 'Num', 'NA', '.', 'YYMMDD10. The event date associated with AVAL and/or AVALC or the dose. When AENDT is populated then this will represent the start date of that dose interval. PC.ADT or EX.EXSTDT', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(29, 'ADY', 'Analysis Relative Day', 'NA', 'Num', 'NA', '.', 'Study day, relative to the start of the study. It can be taken directly from some of the ADaM domains (different ADY variables in different ADaM datasets) or as specified by the modeler', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(30, 'ATM', 'Analysis Time', 'NA', 'Num', 'NA', '.', 'B8601TM. Analysis time associated with AVAL and/or AVALC. When AENTM is populated then this will represent the start date of that interval as would be expected in urinalysis. Analysis time of event or censoring associated with AVAL in numeric format. PC.ATM', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(31, 'ADTM', 'Analysis Date/Time', 'NA', 'Num', 'NA', '.', 'E8601DT. Analysis date/ and time associated with AVAL and/or AVALC. When AENDTM is populated then this will represent the start date of that dose intervalis.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(32, 'AENDT', 'Analysis End Date', 'NA', 'Num', 'NA', '.', 'YYMMDD10. The end date associated with AVAL and/or AVALC. See also ADT.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(33, 'AENTM', 'Analysis End Time', 'NA', 'Num', 'NA', '.', 'B8601TM. The end time associated with AVAL and/or AVALC. See also ATM.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(34, 'AENDTM', 'Analysis End Date/Time', 'NA', 'Num', 'NA', '.', 'E8601DT. The end date and time associated with AVAL and/or AVALC.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(35, 'OCC', 'Occasion', 'NA', 'Num', 'NA', '.', 'The implementation is taken directly from the specs/protocol and defined by the modeler', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(36, 'EXCLFC', 'Comment for the Record Exclusion', 'NA', 'Char', 'NA', 'blank', 'It can be captured prior to the modeling or after some analysis, with possible iterations and adjustments. Some possible reasons: BLOQ, biological implausibility, outlier based on variability metrics, incorrect dosing information, day 1 pre-dose sample. This can also be coded through numbers that are connected with different reasons. Based on data specification. Could come from multiple sources, e.g., SDTM or ADaM source, CRITyFN variable', NULL, 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(37, 'EXCLF', 'Record Exclusion', 'NA', 'Num', 'NA', '0', 'It can be captured prior to the modeling or after some analysis, with possible iterations and adjustments. Some possible reasons: BLOQ, biological implausibility, IWER>threshold, incorrect dosing information. There can be several reasons for flagging data during the data set creation e.g., day 1 pre dose samples, missing sample information, deviation of actual time from nominal time > threshold, etc.', NULL, 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(38, 'FLAG', 'Flagged Records', 'NA', 'Num', 'NA', '0', 'Captures exclusion flags plus any non-exclusion flags like dose time imputation flags etc. It’s a sequential number starting with 1 and increments with each flag.', 'FLAG number per Flag table in Programming Algorithms and Imputations section.', 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(39, 'FLAGC', 'Comment for the Flagged Records', 'NA', 'Char', 'NA', 'blank', 'Captures reason for exclusion flags plus any nonexclusion flags like dose time imputation flags etc.', 'Description for FLAG per Flag table in Programming Algorithms and Imputations section.', 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(40, 'DVID', 'Dependent Variable Name', 'NA', 'Char', 'NA', 'blank', 'Analyte/drug name. Most of the time ADaM is not available when we prepare PMX datasets, so we pull from SDTM. PC.PCTEST for PK, EX for dose, ADLB for labs', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(41, 'DVIDN', 'Dependent Variable Name (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of DVID.. Convention is normally 0=dose, 1=for the first observation of interest, etc.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(42, 'CMT', 'Compartment', 'NA', 'Num', 'NA', '.', 'Derived based on the specifications from modeler.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(43, 'DV', 'Analysis Value', 'ug/mL', 'Num', 'NA', '.', 'Numeric analysis value', NULL, 1, 'PPK-standard', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(44, 'DVC', 'Analysis Value (C)', 'NA', 'Char', 'NA', 'blank', 'Character results/findings in a standard format. PC.PCSTRESC (SDTM) or AVALC (ADaM).', NULL, 0, 'PPK-standard', 0, 1, 0, 0, 0, 1, 1, 1, NULL),
(45, 'DVL', 'Log Analysis Value', 'NA', 'Num', '4 significant digits', '.', 'Natural log. It\'s \'.\' (CDISC value for null) if value is 0 and log otherwise', NULL, 0, 'PPK-standard', 0, 1, 0, 0, 1, 1, 1, 1, NULL),
(46, 'EVID', 'Event ID', 'NA', 'Num', 'NA', '.', 'Derived based on the standard codes in the codelist', NULL, 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(47, 'MDV', 'Missing DV', 'NA', 'Num', 'NA', '.', 'Derived based on the standard codes in the codelist', NULL, 1, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(48, 'PCULOQ', 'Upper Limit of Quantitation', 'ug/mL', 'Num', 'NA', '.', 'In assay report', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(49, 'PCLLOQ', 'Lower Limit of Quantitation', 'ug/mL', 'Num', 'NA', '.', 'In assay report or CSR. PC.PCLLOQ', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(50, 'BLQFN', 'Blq Flag', 'NA', 'Num', 'NA', '.', '0=No, 1=Yes.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(51, 'ALQFN', 'Alq Flag', 'NA', 'Num', 'NA', '.', '0=No, 1=Yes.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(52, 'DOSEA', 'Actual Treatment Dose', 'mg', 'Num', 'NA', '.', 'DOSEA represents the actual treatment dosage associated with the record. This is the actual numeric amount of the dose used for the population analysis and may differ from the EX.EXDOSE. It can be derived from the EX.EXDOSE or based on related dose. Populated on all individual records as carry-forward', NULL, 1, 'PPK-standard', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(53, 'DOSEP', 'Planned Treatment Dose', 'mg', 'Num', 'NA', '.', 'DOSEP represents the planned treatment dosage associated with the record. This is the numeric amount of the dose used for the popPK analysis and may differ from the EX.EXDOSE. Populated on all individual records as carry-forward.', NULL, 0, 'PPK-standard', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(54, 'AMT', 'Actual Amount of Drug Received', 'mg', 'Num', 'NA', '.', 'Only populated on dosing records.', NULL, 1, 'PPK-standard', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(55, 'DOSCUMA', 'Cumulative Amount of Dose Received', 'mg', 'Num', 'NA', '.', 'Calculated by adding the doses up as we go.', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(56, 'DOSETDD', 'Total Daily Amount of Dose Received', 'mg', 'Num', 'NA', '.', 'Used mostly for b.i.d. dosing schemes.', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(57, 'DOSEDUR', 'Duration of Treatment Dose', 'hr', 'Num', '0.01', '.', 'This record is generally considered to be associated with an infusion dose and is distinct from TRTDURD, TRTDURM, and TRTDURY which references the duration of the entire study rather than the duration of a single treatment event. \"EX domain 1) Derived from EXENDTC - EXSTDTC. 2) Taken from EXDUR. In case we need to extend, additional column could be defined Derived from TRTRSDTM - TRTREDTM.\" The label should contain the unit of time.', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(58, 'RATE', 'Infusion Rate', 'mg/hr', 'Num', '0.01', '.', 'Units are the units of AMT divided by the units of DOSEDUR. AMT/DOSEDUR or calculated otherwise', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(59, 'II', 'Dosing Interval', 'hr', 'Num', 'NA', '.', '24 for QD, 12 for BID, etc… If time units are hours. Connected with time units in TIMEUNIT Protocol or some inspiration in EX.EXDOSFRQ', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(60, 'ADDL', 'Number of Additional Doses', 'NA', 'Num', 'NA', '.', 'Number of additional doses like the current one until the next dose, e.g. if the value is 1 then 1 additional dose, if value is 2 then 2 additional doses. It is commonly used for long lasting studies with frequent dosing in order to not have the dataset extremely large.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(61, 'SS', 'Steady State', 'NA', 'Num', 'NA', '.', 'A steady-state dose is a dose that is imagined to be the last of a series of implied doses, each exactly like the dose in question, given at a regular interval specified by the II data item and leading to steady-state by the time the steady-state dose is given.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(62, 'FORM', 'Formulation', 'NA', 'Char', 'NA', 'blank', 'Type of formulation (e.g., tablet, capsule, aerosole) EX.DOSFRM or Protocol', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(63, 'FORMN', 'Formulation (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of FORMN', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(64, 'ROUTE', 'Route', 'NA', 'Char', 'NA', 'blank', 'Route of treatment delivery. May be derived from the EX.EXROUTE.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(65, 'ROUTEN', 'Route (N)', 'NA', 'Num', 'NA', '.', 'Derived from ROUTE as one-on-one unique match', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(66, 'TRTP', 'Planned Treatment', 'NA', 'Char', 'NA', 'blank', 'TRTP is a record-level identifier that represents the planned treatment attributed to a record for analysis purposes. Record-level identifier that represents the planned treatment attributed to a record for analysis purposes. This variable should contain both the name of the drug and the dose amount. and may also include information related to delivery of the drug if it is relevant for the analysis.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(67, 'TRTPN', 'Planned Treatment (N)', 'NA', 'Num', 'NA', '.', 'The numeric code for TRTP. There must be a one-to-one map to TRTP. One-to-one map to TRTP', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(68, 'TRTA', 'Actual Treatment', 'NA', 'Char', 'NA', 'blank', 'TRTA is a record-level identifier that represents the actual treatment attributed to a record for analysis purposes. TRTA is a record-level identifier that represents the actual treatment attributed to a record for analysis purposes. This variable should contain both the name of the drug and the dose amount and may also include information related to delivery of the drug if it is relevant for the analysis.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(69, 'TRTAN', 'Actual Treatment (N)', 'NA', 'Num', 'NA', '.', 'The numeric code for TRTA. There must be a one-to-one map to TRTA.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(70, 'APHASE', 'Phase', 'NA', 'Char', 'NA', 'blank', 'Higher level categorization than period. APHASE (ADaM IG)', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(71, 'APHASEN', 'Phase (N)', 'NA', 'Num', 'NA', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(72, 'APERIOD', 'Period', 'NA', 'Num', 'NA', '.', 'Record-level timing variable that represents the analysis period within the study associated with the record for analysis purposes. The value of APERIOD (if populated) must be one of the xx values found in the ADSL TRTxxP 17 variables.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(73, 'APERIODC', 'Period (C)', 'NA', 'Char', 'NA', 'blank', 'Text characterizing to which analysis period the record belongs. It must be one-to-one mapping within a dataset to APERIOD. It must be identical to the ADSL variable.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(74, 'ACYCLEC', 'Analysis Cycle', 'NA', 'Char', 'NA', 'blank', 'Record level identifier that reflects cycle and may be of particular importance for studies that examine concentrations in cancer patients. From AVISIT or Protocol', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(75, 'ACYCLEN', 'Analysis Cycle (N)', 'NA', 'Num', 'NA', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(76, 'ARM', 'Description of Planned Arm', 'NA', 'Char', 'NA', 'blank', 'Subject level variable. ADSL.ARM', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(77, 'ARMN', 'Arm (N)', 'NA', 'Num', 'NA', '.', 'Derived from ARM. Ensure consistency across studies when pooling', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(78, 'ACTARM', 'Description of Actual Arm', 'NA', 'Char', 'NA', 'blank', 'Subject level variable', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(79, 'ACTARMN', 'Actual Arm (N)', 'NA', 'Num', 'NA', '.', 'Derived from ACTARM/ACTARMCD. Ensure consistency across studies when pooling', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(80, 'COHORT', 'Cohort Subject Enrolled Into', 'NA', 'Char', 'NA', 'blank', 'Subject level variable. Could be some sort of subpopulation. Study can have 5 cohorts and 3 arms. DM or ADSL.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(81, 'COHORTN', 'Cohort Number Subject Enrolled Into', 'NA', 'Num', 'NA', '.', 'Numeric representation of the COHORT variable. There must be a one-to-one mapping to COHORT.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(82, 'WT', 'Body Weight', 'kg', 'Num', 'NA', '.', 'Variable may be derived from VS.VSTEST and VS.VSORRESU but may also be pulled in from other datasets. Weight is associated with the time of dosing. SDTM, VS or ADVS', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(83, 'WTB', 'Baseline Body Weight', 'kg', 'Num', 'NA', '.', 'Variable may be derived from VS.VSTEST and VS.VSORRESU but may also be pulled in from other datasets. Weight is associated with the time of dosing. Use flags for baseline. SDTM, VS or ADVS', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(84, 'HTB', 'Baseline Height', 'cm', 'Num', 'NA', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSORRESU but may also be pulled in from other 19 datasets. SDTM, VS or ADVS', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(85, 'BMIB', 'Baseline Body Mass Index', 'kg/m2', 'Num', '0.01', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSORRESU but may also be pulled in from other datasets or derived.. ADSL.BMI for baseline and VS.BMI for time-varying or derived', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(86, 'BSAB', 'Baseline Body Surface Area', 'm2', 'Num', '0.01', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(87, 'AGE', 'Age', 'year', 'Num', 'NA', '.', 'DM.AGE or ADSL.AGE. If analysis needs require a derived age that does not match ADSL.AGE, then AAGE (Analysis Age) must be added.', NULL, 1, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(88, 'SEX', 'Sex', 'NA', 'Char', 'NA', 'blank', 'The sex of the subject is a required variable in ADSL; must be identical to DM.SEX or ADSL.SEX. Single value for all records within a patient. When integrating multiple studies, need to conform the values across studies to show the same convention. For example, the values should be F or FEMALE across the studies but not combination of both the values.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(89, 'SEXN', 'Sex (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of SEX. From DM or ADSL.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(90, 'RACE', 'Race', 'NA', 'Char', 'NA', 'blank', 'The race of the subject is a required variable in ADSL; identical to DM.RACE or ADSL.RACE. May categorize differently if analysis demands.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(91, 'RACEN', 'Race (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of RACE. Codes used as per the specification.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(92, 'ETHNIC', 'Ethnicity', 'NA', 'Char', 'NA', 'blank', 'Derived based on RACE and COUNTRY if not in the SDTM/AdaM datasets', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(93, 'ETHNICN', 'Ethnicity (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of ETHNIC.', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(94, 'REGION', 'Region', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(95, 'REGIONN', 'Region (N)', 'NA', 'Num', 'NA', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(96, 'COUNTRY', 'Country', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(97, 'COUNTRYN', 'Country (N)', 'NA', 'Num', 'NA', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(98, 'CREATB', 'Baseline Creatinine Serum', 'mg/dL', 'Num', 'NA', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(99, 'CRCLB', 'Baseline Creatinine Clearance', 'mL/min', 'Num', '0.01', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(100, 'EGFRB', 'Baseline eGFR', 'mL/min/1.73m2', 'Num', '0.01', '.', 'eGFR: Estimated Glomerular Filtration Rate.', NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(101, 'TBILB', 'Baseline Total Bilirubin', 'mg/dL', 'Num', 'NA', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(102, 'ASTB', 'Baseline Aspartate Transaminase', 'U/L', 'Num', 'NA', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(103, 'ALTB', 'Baseline Alanine Transaminase', 'U/L', 'Num', 'NA', '.', NULL, NULL, 0, 'PPK-standard', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(104, 'ITTFL', 'Intent-to-treat Population Flag', 'NA', 'Char', 'NA', 'blank', 'ADSL.ITTFL', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(105, 'ITTFN', 'Intent-to-treat Population Flag (N)', 'NA', 'Num', 'NA', '.', 'ADSL.ITTFL with \"Yes\" or \"Y\" = 1 and \"No\" or \"N\"=0', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(106, 'COMPLFL', 'Completers Population Flag', 'NA', 'Char', 'NA', 'blank', 'ADSL.COMPLFL', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(107, 'COMPLFN', 'Completers Population Flag (N)', 'NA', 'Num', 'NA', '.', 'ADSL.COMPLFL with \"Yes\" or \"Y\" = 1 and \"No\" or \"N\"=0', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(108, 'TCOMPLFL', 'Treatment Completers Population Flag', 'NA', 'Char', 'NA', 'blank', 'ADSL.TCOMPLFL', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(109, 'TCOMPLFN', 'Treatment Completers Population Flag (N)', 'NA', 'Num', 'NA', '.', 'ADSL.TCOMPLFL with \"Yes\" or \"Y\" = 1 and \"No\" or \"N\"=0', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(110, 'SAFFL', 'Safety Population Flag', 'NA', 'Char', 'NA', 'blank', 'ADSL.SAFFL', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(111, 'SAFFN', 'Safety Population Flag (N)', 'NA', 'Num', 'NA', '.', 'ADSL.SAFFL with \"Yes\" or \"Y\" = 1 and \"No\" or \"N\"=0', NULL, 0, 'PPK-standard', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(112, 'STUDYID', 'Study Identifier', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 1, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(113, 'USUBJID', 'Unique Subject Identifier', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 1, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(114, 'GR3F', 'Flag of Gr3+ AE', 'NA', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'gr3'),
(115, 'GR3C', 'AE Term of Gr3+ AE', 'NA', 'Char', 'NA', 'blank', 'Gr3+: Grade 3 or higher, AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'gr3'),
(116, 'GR3M', 'Time to Gr3+ AE', 'month', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'gr3'),
(117, 'GR3D', 'Time to Gr3+ AE', 'day', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'gr3'),
(118, 'AEDCDF', 'Flag of AE-DC/D', 'NA', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'aedcd'),
(119, 'AEDCDC', 'AE Term of AE-DC/D', 'NA', 'Char', 'NA', 'blank', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'aedcd'),
(120, 'AEDCDM', 'Time to AE-DC/D', 'month', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'aedcd'),
(121, 'AEDCDD', 'Time to AE-DC/D', 'day', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'aedcd'),
(122, 'IMAEF', 'Flag of Immune-Mediated AE', 'NA', 'Num', 'NA', '.', 'AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'imae'),
(123, 'IMAEC', 'AE Term of Immune-Mediated AE', 'NA', 'Char', 'NA', 'blank', 'AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'imae'),
(124, 'IMAEM', 'Time to Immune-Mediated AE', 'month', 'Num', 'NA', '.', 'AE: Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'imae'),
(125, 'IMAED', 'Time to Immune-Mediated AE', 'day', 'Num', 'NA', '.', 'AE: Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'imae'),
(126, 'IMAEGR2F', 'Flag of Gr2+ IMAE', 'NA', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, IMAE: Immune-Mediated Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'imaegr2'),
(127, 'IMAEGR2C', 'AE Term of Gr2+ IMAE', 'NA', 'Char', 'NA', 'blank', 'Gr2+: Grade 2 or higher, IMAE: Immune-Mediated Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'imaegr2'),
(128, 'IMAEGR2M', 'Time to Gr2+ IMAE', 'month', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, IMAE: Immune-Mediated Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'imaegr2'),
(129, 'IMAEGR2D', 'Time to Gr2+ IMAE', 'day', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, IMAE: Immune-Mediated Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'imaegr2'),
(130, 'DRAEDCDF', 'Flag of Drug-Related AE-DC/D', 'NA', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'draedcd'),
(131, 'DRAEDCDC', 'AE Term of Drug-Related AE-DC/D', 'NA', 'Char', 'NA', 'blank', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'draedcd'),
(132, 'DRAEDCDM', 'Time to Drug-Related AE-DC/D', 'month', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'draedcd'),
(133, 'DRAEDCDD', 'Time to Drug-Related AE-DC/D', 'day', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'draedcd'),
(134, 'DRGR2F', 'Flag of Drug-Related Gr2+ AE', 'NA', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drgr2'),
(135, 'DRGR2C', 'AE Term of Drug-Related Gr2+ AE', 'NA', 'Char', 'NA', 'blank', 'Gr2+: Grade 2 or higher, AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drgr2'),
(136, 'DRGR2M', 'Time to Drug-Related Gr2+ AE', 'month', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drgr2'),
(137, 'DRGR2D', 'Time to Drug-Related Gr2+ AE', 'day', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drgr2'),
(138, 'DRGR3F', 'Flag of Drug-Related Gr3+ AE', 'NA', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drgr3'),
(139, 'DRGR3C', 'AE Term of Drug-Related Gr3+ AE', 'NA', 'Char', 'NA', 'blank', 'Gr3+: Grade 3 or higher, AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drgr3'),
(140, 'DRGR3M', 'Time to Drug-Related Gr3+ AE', 'month', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drgr3'),
(141, 'DRGR3D', 'Time to Drug-Related Gr3+ AE', 'day', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drgr3'),
(142, 'DRAEF', 'Flag of Drug-Related AE', 'NA', 'Num', 'NA', '.', 'AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drae'),
(143, 'DRAEC', 'AE Term of Drug-Related AE', 'NA', 'Char', 'NA', 'blank', 'AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drae'),
(144, 'DRAEM', 'Time to Drug-Related AE', 'month', 'Num', 'NA', '.', 'AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drae'),
(145, 'DRAED', 'Time to Drug-Related AE', 'day', 'Num', 'NA', '.', 'AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drae'),
(146, 'BOR', 'Best Overall Response', 'NA', 'Char', 'NA', 'blank', 'CR=Complete response, PR=Partial response, SD=Stable disease, PD=Progressive disease, NE=Unevaluable, NA=Missing or not reported, NN=NON-CR/NON-PD, ND=No Disease.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'bor'),
(147, 'BORN', 'Best Overall Response (N)', 'NA', 'Num', 'NA', '.', '1=CR, 2=PR, 3=SD, 4=PD, 5=NE, 6=NA, 7=NN, 8=ND', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'bor'),
(148, 'BORPER', 'BOR Assessed by', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'bor'),
(149, 'BORCRT', 'BOR Criteria', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'bor'),
(150, 'PFSC', 'Censoring Progression-Free Survival', 'NA', 'Num', 'NA', '.', '0=Censored, 1=Death/Event', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'pfs'),
(151, 'PFSD', 'Time to Progression-Free Survival', 'day', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'pfs'),
(152, 'PFSM', 'Time to Progression-Free Survival', 'month', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'pfs'),
(153, 'OSC', 'Censoring Overall Survival', 'NA', 'Num', 'NA', '.', '0=Censored, 1=Death/Event', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'os'),
(154, 'OSD', 'Time to Overall Survival', 'day', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'os'),
(155, 'OSM', 'Time to Overall Survival', 'month', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'os'),
(156, 'PROJID', 'Project Identifier', 'NA', 'Char', 'NA', 'blank', 'Text representing protocol or compound name', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(157, 'PROJIDN', 'Project Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of PROJID', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(158, 'STUDYIDN', 'Study Identifier (N)', 'NA', 'Num', 'NA', '.', 'Must be identical to the ADSL variable', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(159, 'USUBJIDN', 'Unique Subject Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of USUBJID.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(160, 'RECSEQ', 'Record Sequence', 'NA', 'Num', 'NA', '.', 'Sequential values should start with 1 on the first non-header row of the data file and incrementing by 1 for each subsequent row.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(161, 'ARM', 'Description of Planned Arm', 'NA', 'Char', 'NA', 'blank', 'Subject level variable. ADSL.ARM', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(162, 'ARMN', 'Arm (N)', 'NA', 'Num', 'NA', '.', 'Derived from ARM. Ensure consistency across studies when pooling', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(163, 'ACTARM', 'Description of Actual Arm', 'NA', 'Char', 'NA', 'blank', 'Subject level variable', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(164, 'ACTARMN', 'Actual Arm (N)', 'NA', 'Num', 'NA', '.', 'Derived from ACTARM/ACTARMCD. Ensure consistency across studies when pooling', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(165, 'COHORT', 'Cohort Subject Enrolled Into', 'NA', 'Char', 'NA', 'blank', 'Subject level variable. Could be some sort of subpopulation. Study can have 5 cohorts and 3 arms. DM or ADSL.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(166, 'COHORTN', 'Cohort Number Subject Enrolled Into', 'NA', 'Num', 'NA', '.', 'Numeric representation of the COHORT variable. There must be a one-to-one mapping to COHORT.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(167, 'RACE', 'Race', 'NA', 'Char', 'NA', 'blank', 'The race of the subject is a required variable in ADSL; identical to DM.RACE or ADSL.RACE. May categorize differently if analysis demands.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(168, 'RACEN', 'Race (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of RACE. Codes used as per the specification.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(169, 'SEX', 'Sex', 'NA', 'Char', 'NA', 'blank', 'The sex of the subject is a required variable in ADSL; must be identical to DM.SEX or ADSL.SEX. Single value for all records within a patient. When integrating multiple studies, need to conform the values across studies to show the same convention. For example, the values should be F or FEMALE across the studies but not combination of both the values.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(170, 'SEXN', 'Sex (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of SEX. From DM or ADSL.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 1, 1, 1, 1, NULL),
(171, 'AGE', 'Age', 'year', 'Num', 'NA', '.', 'DM.AGE or ADSL.AGE. If analysis needs require a derived age that does not match ADSL.AGE, then AAGE (Analysis Age) must be added.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(172, 'COUNTRY', 'Country', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(173, 'COUNTRYN', 'Country (N)', 'NA', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(174, 'WTB', 'Baseline Body Weight', 'kg', 'Num', 'NA', '.', 'Variable may be derived from VS.VSTEST and VS.VSORRESU but may also be pulled in from other datasets. Weight is associated with the time of dosing. SDTM, VS or ADVS', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(175, 'HTB', 'Baseline Height', 'cm', 'Num', 'NA', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSORRESU but may also be pulled in from other 19 datasets. SDTM, VS or ADVS', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(176, 'BMIB', 'Baseline Body Mass Index', 'kg/m2', 'Num', '0.01', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSORRESU but may also be pulled in from other datasets or derived.. ADSL.BMI for baseline and VS.BMI for time-varying or derived', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(177, 'BSAB', 'Baseline Body Surface Area', 'm2', 'Num', '0.01', '.', NULL, NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(178, 'ALTB', 'Baseline Alanine Transaminase', 'U/L', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(179, 'ASTB', 'Baseline Aspartate Transaminase', 'U/L', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-optional', 0, 0, 1, 0, 0, 1, 1, 1, NULL),
(180, 'CRCLB', 'Baseline Creatinine Clearance', 'mL/min', 'Num', '0.01', '.', NULL, NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(181, 'CREATB', 'Baseline Creatinine Serum', 'mg/dL', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(182, 'EGFRB', 'Baseline eGFR', 'mL/min/1.73m2', 'Num', '0.01', '.', 'eGFR: Estimated Glomerular Filtration Rate.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(183, 'TBILB', 'Baseline Total Bilirubin', 'mg/dL', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(184, 'FLAG', 'Flagged Records', 'NA', 'Num', 'NA', '0', NULL, 'FLAG number per Flag table in Programming Algorithms and Imputations section.', 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(185, 'FLAGC', 'Comment for the Flagged Records', 'NA', 'Char', 'NA', 'blank', NULL, 'Description for FLAG per Flag table in Programming Algorithms and Imputations section.', 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(186, 'STUDYID', 'Study Identifier', 'NA', 'Char', 'NA', 'blank', 'Must be identical to the ADSL variable', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(187, 'USUBJID', 'Unique Subject Identifier', 'NA', 'Char', 'NA', 'blank', 'Must be identical to the ADSL variable', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(188, 'EVID', 'Event ID', 'NA', 'Num', 'NA', '.', 'Derived based on the standard codes in the codelist', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(189, 'AFRELTM', 'Actual Rel Time From First Dose', 'hr', 'Num', '0.01', '.', 'Rel: Relative. Actual elapsed time (for sample point or start of sampling interval) from first dose to study treatment. Could be negative. We recommend that variables ending in RELTM be excluded from the TM timing format. Derived from (ADTM of the current event/record of the subject) - (ADTM of the first dosing event/record of the subject)', NULL, 0, 'Blank Template', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(190, 'APRELTM', 'Actual Rel Time From Previous Dose', 'hr', 'Num', '0.01', '.', 'Rel: Relative. Derived from (Analysis date/time of the current event/record of the subject) - (Analysis date/time of the previous dosing event/record of the subject).', NULL, 0, 'Blank Template', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(191, 'NFRELTM', 'Nominal Rel Time From First Dose', 'hr', 'Num', '0.1', '.', 'Rel: Relative. Planned elapsed time (for sample point or start of sampling interval) from first exposure to study treatment. We recommend that variables ending in RELTM be excluded from the TM timing format. For PK it will be in PC domain', NULL, 0, 'Blank Template', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(192, 'NPRELTM', 'Nominal Rel Time From Previous Dose', 'hr', 'Num', '0.1', '.', 'Rel: Relative. For PK it can be derived from NRRELTM or equivant variable that has nominal time in PC domain', NULL, 0, 'Blank Template', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(193, 'DV', 'Analysis Value', 'ug/mL', 'Num', 'NA', '.', 'Numeric analysis value', NULL, 0, 'Blank Template', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(194, 'DVL', 'Log Analysis Value', 'NA', 'Num', '4 significant digits', '.', 'Natural log. It\'s \'.\' (CDISC value for null) if value is 0 and log otherwise', NULL, 0, 'Blank Template', 0, 1, 0, 0, 1, 1, 1, 1, NULL),
(195, 'MDV', 'Missing DV', 'NA', 'Num', 'NA', '.', 'Derived based on the standard codes in the codelist', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(196, 'AMT', 'Actual Amount of Drug Received', 'mg', 'Num', 'NA', '.', 'Only populated on dosing records. Use \".\" for non-dosing record (i.e., observations)', NULL, 0, 'Blank Template', 0, 1, 1, 0, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `new_view`
-- (See below for the actual view)
--
CREATE TABLE `new_view` (
`user_id` varchar(20)
,`role_name` varchar(50)
,`screen_name` varchar(50)
,`first_name` varchar(50)
,`last_name` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_name` varchar(50) NOT NULL COMMENT 'Name of the role',
  `role_description` varchar(200) DEFAULT NULL COMMENT 'Role description',
  `created_by` varchar(20) NOT NULL COMMENT 'User id of user that created the record',
  `created_date` datetime NOT NULL COMMENT 'Date when record was created',
  `last_modified_by` varchar(20) NOT NULL COMMENT 'User id of user that modified the record',
  `last_modified_date` datetime NOT NULL COMMENT 'Date when record was last modified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_name`, `role_description`, `created_by`, `created_date`, `last_modified_by`, `last_modified_date`) VALUES
('Admin', 'Administrator Role to add users', 'pmwebspecadmin@140.1', '2018-09-05 14:28:05', '', '2021-10-26 01:48:40'),
('CreateSpecOnly', 'To allow users only to create spec', 'pmwebspecadmin@140.1', '2018-09-05 14:28:05', 'testu1', '2019-10-30 13:29:09'),
('Directory Setup', 'Test', 'testu1', '2021-10-14 10:47:02', 'testu1', '2021-10-14 10:47:02'),
('SuperUser', 'to create and export spec', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06', '', '2021-10-22 01:43:02'),
('test_role', 'just for testing ', 'testu1', '2020-08-05 05:29:05', 'testu1', '2020-08-05 05:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `role_screen_mapping`
--

CREATE TABLE `role_screen_mapping` (
  `role_name` varchar(50) NOT NULL COMMENT 'Name of the role',
  `screen_name` varchar(50) NOT NULL COMMENT 'Name of the screen',
  `created_by` varchar(20) NOT NULL COMMENT 'User id of the user that created the record',
  `created_date` datetime NOT NULL COMMENT 'Date when record was created',
  `last_modified_by` varchar(20) NOT NULL COMMENT 'User Id of the user who modified this record',
  `last_modified_date` datetime NOT NULL COMMENT 'Date when record was last modified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='roles vs screen mapping';

--
-- Dumping data for table `role_screen_mapping`
--

INSERT INTO `role_screen_mapping` (`role_name`, `screen_name`, `created_by`, `created_date`, `last_modified_by`, `last_modified_date`) VALUES
('CreateSpecOnly', 'CreateNew', 'testu1', '2019-10-30 13:29:09', 'testu1', '2019-10-30 13:29:09'),
('CreateSpecOnly', 'copyExist', 'testu1', '2019-10-30 13:29:09', 'testu1', '2019-10-30 13:29:09'),
('CreateSpecOnly', 'Modify', 'testu1', '2019-10-30 13:29:09', 'testu1', '2019-10-30 13:29:09'),
('CreateSpecOnly', 'Approve', 'testu1', '2019-10-30 13:29:09', 'testu1', '2019-10-30 13:29:09'),
('CreateSpecOnly', 'Export', 'testu1', '2019-10-30 13:29:09', 'testu1', '2019-10-30 13:29:09'),
('CreateSpecOnly', 'Directory', 'testu1', '2019-10-30 13:29:09', 'testu1', '2019-10-30 13:29:09'),
('test_role', 'CreateNew', 'testu1', '2020-08-05 05:29:05', 'testu1', '2020-08-05 05:29:05'),
('test_role', 'Download', 'testu1', '2020-08-05 05:29:05', 'testu1', '2020-08-05 05:29:05'),
('test_role', 'Export', 'testu1', '2020-08-05 05:29:05', 'testu1', '2020-08-05 05:29:05'),
('Directory Setup', 'Directory', 'testu1', '2021-10-14 10:47:02', 'testu1', '2021-10-14 10:47:02'),
('SuperUser', 'Export', 'God', '2021-10-22 01:43:02', 'God', '2021-10-22 01:43:02'),
('SuperUser', 'CreateNew', 'God', '2021-10-22 01:43:02', 'God', '2021-10-22 01:43:02'),
('SuperUser', 'Approve', 'God', '2021-10-22 01:43:02', 'God', '2021-10-22 01:43:02'),
('SuperUser', 'Download', 'God', '2021-10-22 01:43:02', 'God', '2021-10-22 01:43:02'),
('SuperUser', 'copyExist', 'God', '2021-10-22 01:43:02', 'God', '2021-10-22 01:43:02'),
('SuperUser', 'Directory', 'God', '2021-10-22 01:43:02', 'God', '2021-10-22 01:43:02'),
('Admin', 'CreateNew', 'testu1', '2021-10-26 01:48:40', 'testu1', '2021-10-26 01:48:40'),
('Admin', 'manageUsers', 'testu1', '2021-10-26 01:48:40', 'testu1', '2021-10-26 01:48:40'),
('Admin', 'copyExist', 'testu1', '2021-10-26 01:48:40', 'testu1', '2021-10-26 01:48:40'),
('Admin', 'Approve', 'testu1', '2021-10-26 01:48:40', 'testu1', '2021-10-26 01:48:40'),
('Admin', 'Download', 'testu1', '2021-10-26 01:48:40', 'testu1', '2021-10-26 01:48:40'),
('Admin', 'Export', 'testu1', '2021-10-26 01:48:40', 'testu1', '2021-10-26 01:48:40'),
('Admin', 'Directory', 'testu1', '2021-10-26 01:48:40', 'testu1', '2021-10-26 01:48:40'),
('Admin', 'Modify', 'testu1', '2021-10-26 01:48:40', 'testu1', '2021-10-26 01:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `screen_name` varchar(50) NOT NULL COMMENT 'Name of the screen',
  `screen_description` varchar(200) DEFAULT NULL COMMENT 'Short description of the screen',
  `created_by` varchar(20) NOT NULL COMMENT 'User id of user that created the record',
  `created_date` datetime NOT NULL COMMENT 'Date when record was created',
  `last_modified_by` varchar(20) NOT NULL COMMENT 'User id of user that last modified the record',
  `last_modified_date` datetime NOT NULL COMMENT 'Date when record was last modified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='screen records';

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`screen_name`, `screen_description`, `created_by`, `created_date`, `last_modified_by`, `last_modified_date`) VALUES
('Approve', 'To approve an existing spec', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06'),
('copyExist', 'Import existing specification', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06'),
('CreateNew', 'To create new specs', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06'),
('Directory', 'Request for directory setup', 'usr_dbstruct@165.89.', '2019-10-30 17:27:29', 'usr_dbstruct@165.89.', '2019-10-30 17:27:29'),
('Download', 'Download specification to PKMS', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06'),
('Export', 'to export an existing spec', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06'),
('manageUsers', 'Add, update, remove users', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06'),
('Modify', 'Screen to invoke Modify button', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06', 'pmwebspecadmin@140.1', '2018-09-05 14:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(20) NOT NULL COMMENT 'domain Id of the user',
  `first_name` varchar(50) DEFAULT NULL COMMENT 'First Name of the user',
  `last_name` varchar(50) DEFAULT NULL COMMENT 'Last Name of the user',
  `email_address` varchar(50) DEFAULT NULL COMMENT 'Email Address of the user',
  `created_by` varchar(20) NOT NULL COMMENT 'User Id of the user who created this record',
  `created_date` datetime NOT NULL COMMENT 'Date when record was created',
  `last_updated_by` varchar(20) NOT NULL COMMENT 'User Id of the user who last modified this record',
  `last_updated_date` datetime NOT NULL COMMENT 'Date when record was modified',
  `isactive` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='User records';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_address`, `created_by`, `created_date`, `last_updated_by`, `last_updated_date`, `isactive`) VALUES
('boyleb2', 'Shakira', 'Taylor', 'shakira@domain.com', 'testu1', '2018-09-06 07:53:25', 'testu1', '2018-09-06 07:53:25', 0),
('testu1', 'Ritesh', 'Sinha', 'ritesh.sinha@domain.com', 'testu1', '2018-09-05 14:31:06', 'testu1', '2022-01-06 07:17:23', 0),
('testu1', 'Test', 'User', 'test@domain.com', 'testu1', '2018-09-06 07:53:25', 'testu1', '2018-09-06 07:53:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role_mapping`
--

CREATE TABLE `user_role_mapping` (
  `user_id` varchar(20) NOT NULL COMMENT 'domain Id of the user',
  `role_name` varchar(50) NOT NULL COMMENT 'Name of the role',
  `end_date` date DEFAULT NULL COMMENT 'User lost access',
  `created_by` varchar(20) NOT NULL COMMENT 'User id of the user that created the record',
  `created_date` datetime NOT NULL COMMENT 'Date when record was created',
  `last_modified_by` varchar(20) NOT NULL COMMENT 'User Id of the user who last modified this record',
  `last_modified_date` datetime NOT NULL COMMENT 'Date when record was last modified'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role_mapping`
--

INSERT INTO `user_role_mapping` (`user_id`, `role_name`, `end_date`, `created_by`, `created_date`, `last_modified_by`, `last_modified_date`) VALUES
('testu1', 'SuperUser', NULL, 'testu1', '2018-09-06 07:53:25', 'testu1', '2018-09-06 07:53:25'),
('testu1', 'Admin', NULL, '', '2021-11-23 08:38:48', 'testu1', '2022-01-06 07:17:23'),
('testu1', 'Admin', NULL, '', '2021-11-23 08:38:48', 'testu1', '2022-01-06 07:17:23'),
('testu1', 'SuperUser', NULL, '', '2022-05-10 10:30:29', '', '2022-05-10 10:30:29');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_access`
-- (See below for the actual view)
--
CREATE TABLE `vw_user_access` (
`user_id` varchar(20)
,`role_name` varchar(50)
,`screen_name` varchar(50)
,`first_name` varchar(50)
,`last_name` varchar(50)
);

INSERT INTO `vw_user_access`(`user_id`, `role_name`, `screen_name`, `first_name`, `last_name`) VALUES
('testu1', 'Admin', 'CreateNew', 'testu1', '2018-09-06 07:53:25'),
('testu1', 'Admin', 'manageUsers', '', '2021-11-23 08:38:48'),
('testu1', 'Admin', 'copyExist', '', '2021-11-23 08:38:48'),
('testu1', 'Admin', 'Approve', '', '2022-05-10 10:30:29'),
('testu1', 'Admin', 'Download', 'testu1', '2018-09-06 07:53:25'),
('testu1', 'Admin', 'Export', '', '2021-11-23 08:38:48'),
('testu1', 'Admin', 'Directory', '', '2021-11-23 08:38:48'),
('testu1', 'Admin', 'Modify', '', '2022-05-10 10:30:29');


-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dsstruct`
--
ALTER TABLE `dsstruct`
  ADD PRIMARY KEY (`varorder`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_name`) USING BTREE,
  ADD KEY `role_name` (`role_name`);

--
-- Indexes for table `role_screen_mapping`
--
ALTER TABLE `role_screen_mapping`
  ADD KEY `Role constraint` (`role_name`),
  ADD KEY `Screen Constraint` (`screen_name`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`screen_name`) USING BTREE,
  ADD KEY `screen_name` (`screen_name`);

--
-- Indexes for table `users`
--

--
-- Indexes for table `user_role_mapping`
--
ALTER TABLE `user_role_mapping`
  ADD KEY `User Id constraint` (`user_id`),
  ADD KEY `Role Constraint1` (`role_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dsstruct`
--
ALTER TABLE `dsstruct`
  MODIFY `varorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_screen_mapping`
--
ALTER TABLE `role_screen_mapping`
  ADD CONSTRAINT `Role constraint` FOREIGN KEY (`role_name`) REFERENCES `roles` (`role_name`),
  ADD CONSTRAINT `Screen Constraint` FOREIGN KEY (`screen_name`) REFERENCES `screens` (`screen_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
