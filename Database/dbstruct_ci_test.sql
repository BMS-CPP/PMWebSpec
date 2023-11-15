-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2023 at 08:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dsflag`
--

INSERT INTO `dsflag` (`FlagNum`, `FlagCom`, `FlagNotes`, `SpecType`, `required`) VALUES
(1, 'No Dosing Records, all PK samples flagged; missing sample date and time or concentration; error in dosing date/time', 'This can be due to dosing/sampling date issue; for error in dose date/time, flag-related PK samples with same flag number; negative AFRLT when study day > 0', 'PPK-CDISC', 1),
(2, 'Post first dose LLOQ or BLQ', NULL, 'PPK-CDISC', 1),
(3, 'Day 1 pre-dose samples', NULL, 'PPK-CDISC', 1),
(4, 'Duplicate sample with same concentration at same AFRLT (set up for NCA analysis)', NULL, 'PPK-CDISC', 1),
(5, 'Concentration value outliers', NULL, 'PPK-CDISC', 0),
(6, 'Duplicate samples with different concentrations', NULL, 'PPK-CDISC', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dsstruct`
--

INSERT INTO `dsstruct` (`varorder`, `var_name`, `var_label`, `units`, `type`, `round`, `missVal`, `note`, `source`, `requiredFlag`, `SpecType`, `nameChange`, `labelChange`, `unitChange`, `typeChange`, `roundChange`, `missValChange`, `noteChange`, `sourceChange`, `erflag`) VALUES
(1, 'PROJID', 'Project Identifier', 'NA', 'Char', 'NA', 'blank', 'Text representing protocol or compound name', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(2, 'PROJIDN', 'Project Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of PROJID. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(3, 'STUDYID', 'Study Identifier', 'NA', 'Char', 'NA', 'blank', 'STUDYID. Must be identical to the ADSL variable.', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(4, 'STUDYIDN', 'Study Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of STUDYID. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(5, 'PART', 'Part of the Study', 'NA', 'Num', 'NA', '.', 'As defined per protocol. Required when study has more than 1 part ( e.g., part A, dose escalation and part B, dose evaluation). In SDTM it is mapped in STUDYID by some sponsor companies.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(6, 'SUBJTYP', 'Subject Type', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of subject type.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(7, 'SUBJTYPC', 'Subject Type (C)', 'NA', 'Char', 'NA', 'blank', 'Unique character representation of SUBJTYP. For first-in-human studies, the value can be “Healthy volunteers”', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(8, 'USUBJID', 'Unique Subject Identifier', 'NA', 'Char', 'NA', 'blank', 'Must be identical to the ADSL variable', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(9, 'USUBJIDN', 'Unique Subject Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of USUBJID.', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(10, 'SUBJID', 'Subject Identifier for the Study', 'NA', 'Char', 'NA', 'blank', 'Must be identical to the ADSL variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(11, 'SUBJIDN', 'Subject Identifier for the Study (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of SUBJID. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(12, 'SITEID', 'Study Site Identifier', 'NA', 'Char', 'NA', 'blank', 'Must be identical to the ADSL variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(13, 'SITEIDN', 'Study Site Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of SITEID. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(14, 'RECSEQ', 'Record Sequence', 'NA', 'Num', 'NA', '.', 'Derived sequence for the whole dataset. Sequential values should start with 1 on the first non-header row of the data file (i.e., skipping the variable names) and incrementing by 1 for each subsequent row. These are basically \r\nrow numbers. It is often used for convenience purposes and merging of PK and PD datasets. It can also be useful for the tracking of outlier exclusion, since the variable is preserved from the original to the final dataset.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(15, 'AFRLT', 'Actual Rel Time from First Dose', 'NA', 'Num', 'NA', '.', 'Rel: Relative. Actual elapsed time (for sample point or start of sampling interval) from first exposure to study treatment. Could be negative.  Derived from (ADTM of the current event/record of the subject) - (ADTM of the first dosing event/record of the subject).', NULL, 1, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(16, 'RLTU', 'Relative Time Unit', 'NA', 'Char', 'NA', 'blank', 'Units for all reference times AFRLT, APRLT, NFRLT, NPRLT. Add the unit here or in the time variable label.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(17, 'APRLT', 'Actual Rel Time from Previous Dose', 'NA', 'Num', 'NA', '.', 'Rel: Relative. Derived from (ADTM of the current event/record of the subject) - (ADTM of the previous dosing event/record of the subject).', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(18, 'NFRLT', 'Nominal Rel Time from First Dose', 'NA', 'Num', 'NA', '.', 'Rel: Relative. Planned elapsed time (for sample point or start of sampling interval) from first exposure to study treatment. For PK it will be in the PC dataset.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(19, 'NPRLT', 'Nominal Rel Time from Previous Dose', 'NA', 'Num', 'NA', '.', 'Rel: Relative. For PK it can be derived from \"planned elapsed time (for sample point or start of sampling interval) from reference exposure to study treatment\" or equivalent variable that has nominal time in the PC dataset.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(20, 'OCC', 'Occasion', 'NA', 'Num', 'NA', '.', 'Occasion is a grouping variable. It groups dose and concentration observations for a particular dosing. The implementation is taken directly from the specs/protocol and defined by the modeler. This is a popPK software variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(21, 'EXCLF', 'Record Exclusion', 'NA', 'Num', 'NA', '0', 'It can be captured prior to the modeling or after some analysis, with possible iterations and adjustments. Some possible reasons: BLOQ, biological implausibility, IWER > threshold, incorrect dosing information. There can be several reasons for flagging data during the dataset creation (e.g., day 1 pre-dose samples, missing sample information, deviation of actual time from nominal time > threshold).', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(22, 'EXCLFCOM', 'Comment for the Record Exclusion', 'NA', 'Char', 'NA', 'blank', 'It can be captured prior to the modeling or after some analysis, with possible iterations and adjustments. Some possible reasons: BLOQ, biological implausibility, outlier based on variability metrics, incorrect dosing information, day 1 pre-dose sample. This can also be coded through numbers that are connected with different reasons. Based on data specification. Could come from multiple sources (e.g., SDTM or ADaM source, CRITyFN variable).', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(23, 'FLGREAS', 'Identification of Data Issue Reason', 'NA', 'Num', 'NA', '0', 'Captures primary reason for identifying the record for data issues (e.g., dose time imputation flags). A sequential number starting with 1 and increments with each unique reason.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(24, 'FLGREASC', 'Identification of Data Issue Reason (C)', 'NA', 'Char', 'NA', 'blank', 'Character version of FLGREAS.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(25, 'EVID', 'Event ID', 'NA', 'Num', 'NA', '.', 'EVID=1 is Dosing Event, EVID=0 is observation. It can be expanded to other numbers as defined in the dataset specs. This is a popPK software variable.', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(26, 'DVID', 'Dependent Variable Name', 'NA', 'Char', 'NA', 'blank', 'Analyte/drug name/other measurements (e.g., PC.PCTEST for PK, EX or ADEX for dose, ADLB for labs).', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(27, 'DVIDN', 'Dependent Variable Name (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of DVID. Convention is normally 0=dose, 1=for the first observation of interest, etc. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(28, 'CMT', 'Compartment', 'NA', 'Num', 'NA', '.', 'Derived based on the specifications from modeler. This is a popPK software variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(29, 'DV', 'Dependent Variable Result', 'NA', 'Num', 'NA', '.', 'Numeric result of dependent variable applicable to observation events. DV is a widely used notation in the field of pharmacometrics since its inception for the value of dependent variable (observation). This is a copy of AVAL.', NULL, 1, 'PPK-CDISC', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(30, 'AVAL', 'Analysis Value', 'NA', 'Num', 'NA', '.', 'Numeric analysis value described by PARAM.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(31, 'AVALU', 'Dependent Variable Unit', 'NA', 'Char', 'NA', 'blank', 'Unit for DV and AVAL', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(32, 'USTRESC', 'Result or Finding in Standard Format', 'NA', 'Char', 'NA', 'blank', 'Character results/findings of dependent variable in a standard format. The purpose of this column is to capture which records are BLQ or ALQ in the DV column; for example, PC.PCSTRESC (SDTM), AVAL (ADaM). U is a replacement for the dataset name from where the value came from (e.g., USTRESC is equal to PCSTRESC for PC records).', NULL, 0, 'PPK-CDISC', 1, 0, 0, 0, 0, 1, 1, 1, NULL),
(33, 'MDV', 'Missing Dependent Variable Result', 'NA', 'Num', 'NA', '.', 'If DV= . then MDV=1. (When DV is missing for observation then MDV=1, when EVID=1 then MDV=1). This is a popPK software variable.', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(34, 'AULOQ', 'Analysis Upper Limit of Quantitation', 'NA', 'Num', 'NA', '.', 'In assay report', NULL, 0, 'PPK-CDISC', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(35, 'ALLOQ', 'Analysis Lower Limit of Quantitation', 'NA', 'Num', 'NA', '.', 'LLOQ of PK, PD and any other sources', NULL, 0, 'PPK-CDISC', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(36, 'BLQFL', 'Below Lower Limit of Quant Flag', 'NA', 'Char', 'NA', 'blank', 'Quant: Quantitation. N, Y. Set to Y when the analysis value is below the limit of quantification.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(37, 'BLQFN', 'Below Lower Limit of Quant Flag (N)', 'NA', 'Num', 'NA', '.', 'Quant: Quantitation. 0=N, 1=Y. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(38, 'ALQFL', 'Above the Upper Limit of Quant Flag', 'NA', 'Char', 'NA', 'blank', 'Quant: Quantitation. N, Y. Set to Y when the analysis value is above the limit of quantification.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(39, 'ALQFN', 'Above the Upper Limit of Quant Flag (N)', 'NA', 'Num', 'NA', '.', 'Quant: Quantitation. 0=N, 1=Y. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(40, 'AMT', 'Actual Amount of Dose Received', 'mg', 'Num', 'NA', '.', 'Only populated on dosing records.', NULL, 1, 'PPK-CDISC', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(41, 'DOSEA', 'Actual Treatment Dose', 'mg', 'Num', 'NA', '.', 'DOSEA represents the actual treatment dosage associated with the record. Could be amount (mg) or weight based dose (mg/kg). Units of AMT and DOSEA can be same or different.This is the actual numeric amount of the dose used for the population analysis and may differ from the EX.EXDOSE. It can be derived from the EX.EXDOSE or based on related dose. Populated on all individual records as carry-forward.', NULL, 0, 'PPK-CDISC', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(42, 'DOSETDD', 'Total Daily Amount of Dose Received', 'mg', 'Num', 'NA', '.', 'Used mostly for BID dosing schemes', NULL, 0, 'PPK-CDISC', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(43, 'DOSEDUR', 'Duration Of Dose Administration', 'hr', 'Num', 'NA', '.', 'Duration associated with infusion (IV, SC); distinct from TRTDURD, TRTDURM, and TRTDURY, which reference the duration of the entire study rather than the duration of a single treatment event. \"EX dataset\". Derived from EXENDTC - EXSTDTC. The label should contain the unit of time. Usually same unit as time variables.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(44, 'RATE', 'Infusion Rate', 'mg/hr', 'Num', 'NA', '.', 'Calculated as the amount of dose received divided by the dose duration. Certain modeling methods may require that RATE is set to a specific value.The label should contain the unit (e.g., mg/hr).', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(45, 'II', 'Dosing Interval', 'hr', 'Num', 'NA', '.', 'Describes the dosing frequency for multiple doses (e.g., 24 for QD, 12 for BID, if time unit is hours).', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(46, 'ADDL', 'Number Of Additional Doses', 'NA', 'Num', 'NA', '.', 'Number of additional doses like the current dosing event until the next captured dose (e.g., if the value is 1 then 1 additional dose; if value is 2 then 2 additional doses). It is commonly used for long-lasting studies with frequent dosing in order to not have the dataset extremely large.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(47, 'SS', 'Steady State', 'NA', 'Num', 'NA', '.', 'A steady-state dose is a dose that is presumed to be the last of a series of implied doses, each exactly like the dose in question, given at a regular interval specified by the II data item and leading to steady-state by the time the steady-state dose is given.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(48, 'FORM', 'Drug Formulation', 'NA', 'Char', 'NA', 'blank', 'Type of formulation (e.g., tablet, capsule, aerosol); EX.EXDOSFRM or protocol', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(49, 'FORMN', 'Drug Formulation (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of FORM. The numeric versions of the primary/character variables can be assigned from the corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(50, 'ROUTE', 'Route of Administration', 'NA', 'Char', 'NA', 'blank', 'Route of treatment delivery. May be derived from EX.EXROUTE.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(51, 'ROUTEN', 'Route of Administration (N)', 'NA', 'Num', 'NA', '.', 'Derived from ROUTE as one-on-one unique match. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(52, 'ACYCLE', 'Analysis Cycle', 'NA', 'Num', 'NA', '.', 'Record level identifier that reflects cycle and may be of particular importance for studies that examine concentrations in cancer patients from AVISIT or Protocol.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(53, 'ACYCLEC', 'Analysis Cycle (C)', 'NA', 'Char', 'NA', 'blank', 'Derived from ACYCLE as one-on-one unique match. The character versions of the primary/character variables can be assigned from its corresponding numeric pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(54, 'COHORT', 'Cohort Subject Enrolled Into', 'NA', 'Num', 'NA', '.', 'Subject-level variable. Could be some sort of subpopulation.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(55, 'COHORTC', 'Cohort Subject Enrolled into (C)', 'NA', 'Char', 'NA', 'blank', 'Character representation of the COHORT variable. There must be a one-toone mapping to COHORT. The character versions of the primary/character variables can be assigned from its corresponding numeric pair variable.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(56, 'UDTC', 'Date and Time of the Event', 'NA', 'Char', 'NA', 'blank', 'Datetime associated with event ID represented in ISO 8601 character format. U is a replacement for the dataset name from where the value came from (i.e., UDTC is equal to PCDTC for PC records).', NULL, 0, 'PPK-CDISC', 1, 0, 0, 0, 0, 1, 1, 1, NULL),
(57, 'WT', 'Body Weight', 'kg', 'Num', 'NA', '.', 'Variable may be derived from VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets. Weight is associated with sampling time. SDTM.VS or a Vital Signs analysis dataset.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(58, 'WTBL', 'Baseline Body Weight', 'kg', 'Num', 'NA', '.', 'Variable may be derived from VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets. Weight is associated with the last assessment prior to dosing. Use flags for baseline. SDTM.VS or a Vital Signs analysis dataset. If the definition of this variable in the modeling plan is the same as in the SAP then use the variable in ADSL.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(59, 'HTBL', 'Baseline Body Height', 'cm', 'Num', 'NA', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets. SDTM.VS or a Vital Signs analysis dataset. If the definition of this variable in the modeling plan is the same as in the statistical analysis plan (SAP), then use the variable in ADSL.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(60, 'BMIBL', 'Baseline Body Mass Index', 'kg/m2', 'Num', 'NA', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets (SDTM.VS or a Vital Signs analysis dataset) or derived. ADSL.BMIBL for baseline and VS.BMI for time-varying or derived. If the definition of this variable in the modeling plan is the same as in the SAP then use the variable in ADSL.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(61, 'BSABL', 'Body Surface Area at Baseline', 'm2', 'Num', 'NA', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets (SDTM.VS or a Vital Signs analysis dataset) or derived. ADSL.BSABL for baseline and VS.BSA for time-varying or derived. If the definition of this variable in the modeling plan is the same as in the SAP then use the variable in ADSL.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(62, 'AGE', 'Age', 'year', 'Num', 'NA', '.', 'DM.AGE or ADSL.AGE. If analysis needs require a derived age that does not match ADSL.AGE, then AAGE (Analysis Age) must be added.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(63, 'AGETPT', 'Age at Analysis Timepoint', 'year', 'Num', 'NA', '.', 'Number of years between BRTHDT and ADT.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(64, 'SEX', 'Sex', 'NA', 'Char', 'NA', 'blank', 'The sex of the subject is a required variable in ADSL; must be identical to ADSL.SEX.', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(65, 'SEXN', 'Sex (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of SEX. Can be extended to other values beyond 1 and 2. Example values can be as follows: 1=M, 2=F', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(66, 'RACE', 'Race', 'NA', 'Char', 'NA', 'blank', 'The race of the subject is a required variable in ADSL; identical to ADSL.RACE. May categorize differently if analysis demands.', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(67, 'RACEN', 'Race (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of RACE, e.g., codes used as per the specification. 1=American Indian or Alaska Native, 2=Asian, 3=Black/African American, 4=Native Hawaiian or Other Pacific Islander, 5=White. If races need to be categorized differently, then use variables ARACE and ARACEN.', NULL, 1, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(68, 'ARACE', 'Analysis Race', 'NA', 'Char', 'NA', 'blank', 'To be able to allow different definitions of race. For example, allowing to code American Indian/Alaska Native and Native Hawaiian/Other Pacific Islander are coded as \"Other\". This is analysis-specific and could vary based on analysis needs.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(69, 'ARACEN', 'Analysis Race (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of ARACE; for example: 1=White, 2=Black/African American, 3=Asian, 4=Other, 5=Unknown (e.g., not reported). American Indian/Alaska Native and Native Hawaiian/Other Pacific Islander are coded as 4.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(70, 'AETHNIC', 'Analysis Ethnicity', 'NA', 'Char', 'NA', 'blank', 'Ethnicity as needed for analysis. May be derived.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(71, 'AETHNICN', 'Analysis Ethnicity (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of AETHNIC.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(72, 'REGION', 'Geographic Region', 'NA', 'Char', 'NA', 'blank', 'REGIONy is a permissible variable in ADSL.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(73, 'REGIONN', 'Geographic Region (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of REGIONy.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(74, 'COUNTRY', 'Country', 'NA', 'Char', 'NA', 'blank', 'DM.COUNTRY or ADSL.COUNTRY', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(75, 'COUNTRYL', 'Country Full Name', 'NA', 'Char', 'NA', 'blank', 'COUNTRYL is a human-readable name of the DM.COUNTRY value.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(76, 'COUNTRYN', 'Country (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of COUNTRY.', NULL, 0, 'PPK-CDISC', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(77, 'CREATBL', 'Baseline Creatinine Serum', 'mg/dL', 'Num', 'NA', '.', 'Use the baseline lab value for creatinine serum per the algorithm defined in the SAP.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(78, 'CRCLBL', 'Baseline Creatinine Clearance', 'mL/min', 'Num', 'NA', '.', 'Use the baseline lab value for creatinine clearance per the algorithm defined in the SAP. A formula may be suggested if the value does not exist in the lab dataset.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(79, 'EGFRBL', 'Baseline eGFR', 'mL/min/1.73m2', 'Num', 'NA', '.', 'eGFR: Estimated Glomerular Filtration Rate. Use the baseline lab value for eGFR per the algorithm defined in the SAP. A formula may be suggested if the value does not exist in the lab dataset.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(80, 'TBILBL', 'Baseline Total Bilirubin', 'mg/dL', 'Num', 'NA', '.', 'Use the baseline lab value for total bilirubin per the algorithm defined in the SAP.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(81, 'ASTBL', 'Baseline Aspartate Transaminase', 'U/L', 'Num', 'NA', '.', 'Use the baseline lab value for aspartate transaminase per the algorithm defined in the SAP.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(82, 'ALTBL', 'Baseline Alanine Transaminase', 'U/L', 'Num', 'NA', '.', 'Use the baseline lab value for alanine transaminase per the algorithm defined in the SAP.', NULL, 0, 'PPK-CDISC', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(83, 'STUDYID', 'Study Identifier', 'NA', 'Char', 'NA', 'blank', 'STUDYID. Must be identical to the ADSL variable.', NULL, 1, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(84, 'USUBJID', 'Unique Subject Identifier', 'NA', 'Char', 'NA', 'blank', 'Must be identical to the ADSL variable', NULL, 1, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(85, 'GR3F', 'Flag of Gr3+ AE', 'NA', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'gr3'),
(86, 'GR3C', 'AE Term of Gr3+ AE', 'NA', 'Char', 'NA', 'blank', 'Gr3+: Grade 3 or higher, AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'gr3'),
(87, 'GR3M', 'Time to Gr3+ AE', 'month', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'gr3'),
(88, 'GR3D', 'Time to Gr3+ AE', 'day', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'gr3'),
(89, 'AEDCDF', 'Flag of AE-DC/D', 'NA', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'aedcd'),
(90, 'AEDCDC', 'AE Term of AE-DC/D', 'NA', 'Char', 'NA', 'blank', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'aedcd'),
(91, 'AEDCDM', 'Time to AE-DC/D', 'month', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'aedcd'),
(92, 'AEDCDD', 'Time to AE-DC/D', 'day', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'aedcd'),
(93, 'IMAEF', 'Flag of Immune-Mediated AE', 'NA', 'Num', 'NA', '.', 'AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'imae'),
(94, 'IMAEC', 'AE Term of Immune-Mediated AE', 'NA', 'Char', 'NA', 'blank', 'AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'imae'),
(95, 'IMAEM', 'Time to Immune-Mediated AE', 'month', 'Num', 'NA', '.', 'AE: Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'imae'),
(96, 'IMAED', 'Time to Immune-Mediated AE', 'day', 'Num', 'NA', '.', 'AE: Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'imae'),
(97, 'IMAEGR2F', 'Flag of Gr2+ IMAE', 'NA', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, IMAE: Immune-Mediated Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'imaegr2'),
(98, 'IMAEGR2C', 'AE Term of Gr2+ IMAE', 'NA', 'Char', 'NA', 'blank', 'Gr2+: Grade 2 or higher, IMAE: Immune-Mediated Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'imaegr2'),
(99, 'IMAEGR2M', 'Time to Gr2+ IMAE', 'month', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, IMAE: Immune-Mediated Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'imaegr2'),
(100, 'IMAEGR2D', 'Time to Gr2+ IMAE', 'day', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, IMAE: Immune-Mediated Adverse Events. Time from first treatment to the first event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'imaegr2'),
(101, 'DRAEDCDF', 'Flag of Drug-Related AE-DC/D', 'NA', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'draedcd'),
(102, 'DRAEDCDC', 'AE Term of Drug-Related AE-DC/D', 'NA', 'Char', 'NA', 'blank', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'draedcd'),
(103, 'DRAEDCDM', 'Time to Drug-Related AE-DC/D', 'month', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'draedcd'),
(104, 'DRAEDCDD', 'Time to Drug-Related AE-DC/D', 'day', 'Num', 'NA', '.', 'AE: Adverse Events. DC/D: Drug Discontinuation or Death. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'draedcd'),
(105, 'DRGR2F', 'Flag of Drug-Related Gr2+ AE', 'NA', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drgr2'),
(106, 'DRGR2C', 'AE Term of Drug-Related Gr2+ AE', 'NA', 'Char', 'NA', 'blank', 'Gr2+: Grade 2 or higher, AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drgr2'),
(107, 'DRGR2M', 'Time to Drug-Related Gr2+ AE', 'month', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drgr2'),
(108, 'DRGR2D', 'Time to Drug-Related Gr2+ AE', 'day', 'Num', 'NA', '.', 'Gr2+: Grade 2 or higher, AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drgr2'),
(109, 'DRGR3F', 'Flag of Drug-Related Gr3+ AE', 'NA', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drgr3'),
(110, 'DRGR3C', 'AE Term of Drug-Related Gr3+ AE', 'NA', 'Char', 'NA', 'blank', 'Gr3+: Grade 3 or higher, AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drgr3'),
(111, 'DRGR3M', 'Time to Drug-Related Gr3+ AE', 'month', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drgr3'),
(112, 'DRGR3D', 'Time to Drug-Related Gr3+ AE', 'day', 'Num', 'NA', '.', 'Gr3+: Grade 3 or higher, AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drgr3'),
(113, 'DRAEF', 'Flag of Drug-Related AE', 'NA', 'Num', 'NA', '.', 'AE: Adverse Events. 1=Event, 0=No event (Censored).', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drae'),
(114, 'DRAEC', 'AE Term of Drug-Related AE', 'NA', 'Char', 'NA', 'blank', 'AE: Adverse Events.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'drae'),
(115, 'DRAEM', 'Time to Drug-Related AE', 'month', 'Num', 'NA', '.', 'AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drae'),
(116, 'DRAED', 'Time to Drug-Related AE', 'day', 'Num', 'NA', '.', 'AE: Adverse Events. Time from first treatment to the first drug-related event/censoring.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'drae'),
(117, 'BOR', 'Best Overall Response', 'NA', 'Char', 'NA', 'blank', 'CR=Complete response, PR=Partial response, SD=Stable disease, PD=Progressive disease, NE=Unevaluable, NA=Missing or not reported, NN=NON-CR/NON-PD, ND=No Disease.', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'bor'),
(118, 'BORN', 'Best Overall Response (N)', 'NA', 'Num', 'NA', '.', '1=CR, 2=PR, 3=SD, 4=PD, 5=NE, 6=NA, 7=NN, 8=ND', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'bor'),
(119, 'BORPER', 'BOR Assessed by', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'bor'),
(120, 'BORCRT', 'BOR Criteria', 'NA', 'Char', 'NA', 'blank', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'bor'),
(121, 'PFSC', 'Censoring Progression-Free Survival', 'NA', 'Num', 'NA', '.', '0=Censored, 1=Death/Event', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'pfs'),
(122, 'PFSD', 'Time to Progression-Free Survival', 'day', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'pfs'),
(123, 'PFSM', 'Time to Progression-Free Survival', 'month', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'pfs'),
(124, 'OSC', 'Censoring Overall Survival', 'NA', 'Num', 'NA', '.', '0=Censored, 1=Death/Event', NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 0, 1, 1, 1, 'os'),
(125, 'OSD', 'Time to Overall Survival', 'day', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'os'),
(126, 'OSM', 'Time to Overall Survival', 'month', 'Num', 'NA', '.', NULL, NULL, 0, 'ER-ISOP-safety-efficacy', 0, 0, 0, 0, 1, 1, 1, 1, 'os'),
(127, 'PROJID', 'Project Identifier', 'NA', 'Char', 'NA', 'blank', 'Text representing protocol or compound name', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(128, 'PROJIDN', 'Project Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of PROJID. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(129, 'STUDYIDN', 'Study Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of STUDYID. The numeric versions of the primary/character variables can be assigned from its corresponding character pair variable.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(130, 'USUBJIDN', 'Unique Subject Identifier (N)', 'NA', 'Num', 'NA', '.', 'Unique numerical representation of USUBJID.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(131, 'RECSEQ', 'Record Sequence', 'NA', 'Num', 'NA', '.', 'Derived sequence for the whole dataset. Sequential values should start with 1 on the first non-header row of the data file (i.e., skipping the variable names) and incrementing by 1 for each subsequent row. These are basically \r\nrow numbers. It is often used for convenience purposes and merging of PK and PD datasets. It can also be useful for the tracking of outlier exclusion, since the variable is preserved from the original to the final dataset.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(132, 'ARM', 'Description of Planned Arm', 'NA', 'Char', 'NA', 'blank', 'Subject level variable. ADSL.ARM', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(133, 'ARMN', 'Arm (N)', 'NA', 'Num', 'NA', '.', 'Derived from ARM. Ensure consistency across studies when pooling', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(134, 'ACTARM', 'Description of Actual Arm', 'NA', 'Char', 'NA', 'blank', 'Subject level variable', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(135, 'ACTARMN', 'Actual Arm (N)', 'NA', 'Num', 'NA', '.', 'Derived from ACTARM/ACTARMCD. Ensure consistency across studies when pooling', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(136, 'COHORT', 'Cohort Subject Enrolled Into', 'NA', 'Num', 'NA', '.', 'Subject-level variable. Could be some sort of subpopulation.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(137, 'COHORTC', 'Cohort Subject Enrolled into (C)', 'NA', 'Char', 'NA', 'blank', 'Character representation of the COHORT variable. There must be a one-toone mapping to COHORT. The character versions of the primary/character variables can be assigned from its corresponding numeric pair variable.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(138, 'RACE', 'Race', 'NA', 'Char', 'NA', 'blank', 'The race of the subject is a required variable in ADSL; identical to ADSL.RACE. May categorize differently if analysis demands.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(139, 'RACEN', 'Race (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of RACE, e.g., codes used as per the specification. 1=American Indian or Alaska Native, 2=Asian, 3=Black/African American, 4=Native Hawaiian or Other Pacific Islander, 5=White. If races need to be categorized differently, then use variables ARACE and ARACEN.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(140, 'SEX', 'Sex', 'NA', 'Char', 'NA', 'blank', 'The sex of the subject is a required variable in ADSL; must be identical to ADSL.SEX.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(141, 'SEXN', 'Sex (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of SEX. Can be extended to other values beyond 1 and 2. Example values can be as follows: 1=M, 2=F', NULL, 0, 'ER-optional', 0, 0, 0, 0, 1, 1, 1, 1, NULL),
(142, 'AGE', 'Age', 'year', 'Num', 'NA', '.', 'DM.AGE or ADSL.AGE. If analysis needs require a derived age that does not match ADSL.AGE, then AAGE (Analysis Age) must be added.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(143, 'COUNTRY', 'Country', 'NA', 'Char', 'NA', 'blank', 'DM.COUNTRY or ADSL.COUNTRY', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(144, 'COUNTRYN', 'Country (N)', 'NA', 'Num', 'NA', '.', 'Numeric version of COUNTRY.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(145, 'WTBL', 'Baseline Body Weight', 'kg', 'Num', 'NA', '.', 'Variable may be derived from VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets. Weight is associated with the last assessment prior to dosing. Use flags for baseline. SDTM.VS or a Vital Signs analysis dataset. If the definition of this variable in the modeling plan is the same as in the SAP then use the variable in ADSL.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(146, 'HTBL', 'Baseline Body Height', 'cm', 'Num', 'NA', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets. SDTM.VS or a Vital Signs analysis dataset. If the definition of this variable in the modeling plan is the same as in the statistical analysis plan (SAP), then use the variable in ADSL.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(147, 'BMIBL', 'Baseline Body Mass Index', 'kg/m2', 'Num', 'NA', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets (SDTM.VS or a Vital Signs analysis dataset) or derived. ADSL.BMIBL for baseline and VS.BMI for time-varying or derived. If the definition of this variable in the modeling plan is the same as in the SAP then use the variable in ADSL.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(148, 'BSABL', 'Body Surface Area at Baseline', 'm2', 'Num', 'NA', '.', 'Variable may be derived from baseline VS.VSTEST and VS.VSSTRESN but may also be pulled in from other datasets (SDTM.VS or a Vital Signs analysis dataset) or derived. ADSL.BSABL for baseline and VS.BSA for time-varying or derived. If the definition of this variable in the modeling plan is the same as in the SAP then use the variable in ADSL.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(149, 'ALTBL', 'Baseline Alanine Transaminase', 'U/L', 'Num', 'NA', '.', 'Use the baseline lab value for alanine transaminase per the algorithm defined in the SAP.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(150, 'ASTBL', 'Baseline Aspartate Transaminase', 'U/L', 'Num', 'NA', '.', 'Use the baseline lab value for aspartate transaminase per the algorithm defined in the SAP.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 0, 1, 1, 1, NULL),
(151, 'CRCLBL', 'Baseline Creatinine Clearance', 'mL/min', 'Num', 'NA', '.', 'Use the baseline lab value for creatinine clearance per the algorithm defined in the SAP. A formula may be suggested if the value does not exist in the lab dataset.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(152, 'CREATBL', 'Baseline Creatinine Serum', 'mg/dL', 'Num', 'NA', '.', 'Use the baseline lab value for creatinine serum per the algorithm defined in the SAP.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(153, 'EGFRBL', 'Baseline eGFR', 'mL/min/1.73m2', 'Num', 'NA', '.', 'eGFR: Estimated Glomerular Filtration Rate. Use the baseline lab value for eGFR per the algorithm defined in the SAP. A formula may be suggested if the value does not exist in the lab dataset.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(154, 'TBILBL', 'Baseline Total Bilirubin', 'mg/dL', 'Num', 'NA', '.', 'Use the baseline lab value for total bilirubin per the algorithm defined in the SAP.', NULL, 0, 'ER-optional', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(155, 'FLGREAS', 'Identification of Data Issue Reason', 'NA', 'Num', 'NA', '0', 'Captures primary reason for identifying the record for data issues (e.g., dose time imputation flags). A sequential number starting with 1 and increments with each unique reason.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(156, 'FLGREASC', 'Identification of Data Issue Reason (C)', 'NA', 'Char', 'NA', 'blank', 'Character version of FLGREAS.', NULL, 0, 'ER-optional', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(157, 'STUDYID', 'Study Identifier', 'NA', 'Char', 'NA', 'blank', 'STUDYID. Must be identical to the ADSL variable.', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(158, 'USUBJID', 'Unique Subject Identifier', 'NA', 'Char', 'NA', 'blank', 'Must be identical to the ADSL variable', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(159, 'EVID', 'Event ID', 'NA', 'Num', 'NA', '.', 'EVID=1 is Dosing Event, EVID=0 is observation. It can be expanded to other numbers as defined in the dataset specs. This is a popPK software variable.', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(160, 'AFRLT', 'Actual Rel Time from First Dose', 'NA', 'Num', 'NA', '.', 'Rel: Relative. Actual elapsed time (for sample point or start of sampling interval) from first exposure to study treatment. Could be negative.  Derived from (ADTM of the current event/record of the subject) - (ADTM of the first dosing event/record of the subject).', NULL, 0, 'Blank Template', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(161, 'RLTU', 'Relative Time Unit', 'NA', 'Char', 'NA', 'blank', 'Units for all reference times AFRLT, APRLT, NFRLT, NPRLT. Add the unit here or in the time variable label.', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(162, 'APRLT', 'Actual Rel Time from Previous Dose', 'NA', 'Num', 'NA', '.', 'Rel: Relative. Derived from (ADTM of the current event/record of the subject) - (ADTM of the previous dosing event/record of the subject).', NULL, 0, 'Blank Template', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(163, 'NFRLT', 'Nominal Rel Time from First Dose', 'NA', 'Num', 'NA', '.', 'Rel: Relative. Planned elapsed time (for sample point or start of sampling interval) from first exposure to study treatment. For PK it will be in the PC dataset.', NULL, 0, 'Blank Template', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(164, 'NPRLT', 'Nominal Rel Time from Previous Dose', 'NA', 'Num', 'NA', '.', 'Rel: Relative. For PK it can be derived from \"planned elapsed time (for sample point or start of sampling interval) from reference exposure to study treatment\" or equivalent variable that has nominal time in the PC dataset.', NULL, 0, 'Blank Template', 0, 0, 1, 0, 1, 1, 1, 1, NULL),
(165, 'DV', 'Dependent Variable Result', 'NA', 'Num', 'NA', '.', 'Numeric result of dependent variable applicable to observation events. DV is a widely used notation in the field of pharmacometrics since its inception for the value of dependent variable (observation). This is a copy of AVAL.', NULL, 0, 'Blank Template', 0, 1, 1, 0, 1, 1, 1, 1, NULL),
(166, 'MDV', 'Missing Dependent Variable Result', 'NA', 'Num', 'NA', '.', 'If DV= . then MDV=1. (When DV is missing for observation then MDV=1, when EVID=1 then MDV=1). This is a popPK software variable.', NULL, 0, 'Blank Template', 0, 0, 0, 0, 0, 1, 1, 1, NULL),
(167, 'AMT', 'Actual Amount of Dose Received', 'mg', 'Num', 'NA', '.', 'Only populated on dosing records.', NULL, 0, 'Blank Template', 0, 1, 1, 0, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `new_view`
--

CREATE TABLE `new_view` (
  `user_id` varchar(20) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `screen_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='roles vs screen mapping';

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='screen records';

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='User records';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_address`, `created_by`, `created_date`, `last_updated_by`, `last_updated_date`, `isactive`) VALUES
('boyleb2', 'Shakira', 'Taylor', 'shakira@domain.com', 'testu1', '2018-09-06 07:53:25', 'testu1', '2018-09-06 07:53:25', 0),
('ritest6', 'Ritesh', 'Sinha', 'ritesh.sinha@domain.com', 'testu1', '2018-09-05 14:31:06', 'testu1', '2022-01-06 07:17:23', 0),
('testu1', 'Test', 'User', 'test@domain.com', 'testu1', '2018-09-06 07:53:25', 'testu1', '2018-09-06 07:53:25', 1),
('dsuser', 'DS', 'User', 'dsuser@domain.com', 'testu1', '2023-11-10 00:21:05', 'testu1', '2023-11-10 00:22:00', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_role_mapping`
--

INSERT INTO `user_role_mapping` (`user_id`, `role_name`, `end_date`, `created_by`, `created_date`, `last_modified_by`, `last_modified_date`) VALUES
('testu1', 'SuperUser', NULL, 'testu1', '2018-09-06 07:53:25', 'testu1', '2018-09-06 07:53:25'),
('testu1', 'Admin', NULL, '', '2021-11-23 08:38:48', 'testu1', '2022-01-06 07:17:23'),
('testu1', 'Admin', NULL, '', '2021-11-23 08:38:48', 'testu1', '2022-01-06 07:17:23'),
('testu1', 'SuperUser', NULL, '', '2022-05-10 10:30:29', '', '2022-05-10 10:30:29'),
('dsuser', 'SuperUser', NULL, 'testu1', '2023-11-10 00:21:05', 'testu1', '2023-11-10 00:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `vw_user_access`
--

CREATE TABLE `vw_user_access` (
  `user_id` varchar(20) DEFAULT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `screen_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vw_user_access`
--

INSERT INTO `vw_user_access` (`user_id`, `role_name`, `screen_name`, `first_name`, `last_name`) VALUES
('testu1', 'Admin', 'CreateNew', 'testu1', '2018-09-06 07:53:25'),
('testu1', 'Admin', 'manageUsers', '', '2021-11-23 08:38:48'),
('testu1', 'Admin', 'copyExist', '', '2021-11-23 08:38:48'),
('testu1', 'Admin', 'Approve', '', '2022-05-10 10:30:29'),
('testu1', 'Admin', 'Download', 'testu1', '2018-09-06 07:53:25'),
('testu1', 'Admin', 'Export', '', '2021-11-23 08:38:48'),
('testu1', 'Admin', 'Directory', '', '2021-11-23 08:38:48'),
('testu1', 'Admin', 'Modify', '', '2022-05-10 10:30:29'),
('dsuser', 'SuperUser', 'CreateSpec', 'DS', 'User');

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
  MODIFY `varorder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

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