-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 10:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `woods`
--

-- --------------------------------------------------------

--
-- Table structure for table `accademic_table`
--

CREATE TABLE `accademic_table` (
  `accademic_table_id` bigint(20) UNSIGNED NOT NULL,
  `heading1` varchar(255) DEFAULT NULL,
  `heading2` varchar(255) DEFAULT NULL,
  `heading3` varchar(255) DEFAULT NULL,
  `first_heading_date` varchar(255) DEFAULT NULL,
  `first_date` date DEFAULT NULL,
  `second_heading_date` varchar(255) DEFAULT NULL,
  `second_date` date DEFAULT NULL,
  `buttun` varchar(255) DEFAULT NULL,
  `buttun_url` varchar(255) DEFAULT NULL,
  `background_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accademic_table`
--

INSERT INTO `accademic_table` (`accademic_table_id`, `heading1`, `heading2`, `heading3`, `first_heading_date`, `first_date`, `second_heading_date`, `second_date`, `buttun`, `buttun_url`, `background_picture`) VALUES
(1, 'Academic Calendar', 'We’re Ready When You Are', 'Classes start every 8 weeks.', 'OPENING', '2024-10-24', 'CLOSING', '2024-12-19', 'APPLY', 'student_registration.php', 'Resources/wall papers/230.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admision`
--

CREATE TABLE `admision` (
  `admision_id` bigint(20) UNSIGNED NOT NULL,
  `heading1` varchar(255) DEFAULT NULL,
  `heading2` varchar(255) DEFAULT NULL,
  `heading2_content` text DEFAULT NULL,
  `heading3` varchar(255) DEFAULT NULL,
  `heading3_content` text DEFAULT NULL,
  `heading4` varchar(255) DEFAULT NULL,
  `heading4_content` text DEFAULT NULL,
  `heading5` varchar(255) DEFAULT NULL,
  `heading6` varchar(255) DEFAULT NULL,
  `heading6_content` text DEFAULT NULL,
  `heading6_sub_content` text DEFAULT NULL,
  `heading7` varchar(255) DEFAULT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `tittle1` varchar(255) DEFAULT NULL,
  `tittle2` varchar(255) DEFAULT NULL,
  `tittle3` varchar(255) DEFAULT NULL,
  `button1` varchar(255) DEFAULT NULL,
  `button1_url` varchar(255) DEFAULT NULL,
  `button2` varchar(255) DEFAULT NULL,
  `button2_url` varchar(255) DEFAULT NULL,
  `button3` varchar(255) DEFAULT NULL,
  `button3_url` varchar(255) DEFAULT NULL,
  `background_picture1` varchar(255) DEFAULT NULL,
  `background_picture2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admision`
--

INSERT INTO `admision` (`admision_id`, `heading1`, `heading2`, `heading2_content`, `heading3`, `heading3_content`, `heading4`, `heading4_content`, `heading5`, `heading6`, `heading6_content`, `heading6_sub_content`, `heading7`, `tittle`, `tittle1`, `tittle2`, `tittle3`, `button1`, `button1_url`, `button2`, `button2_url`, `button3`, `button3_url`, `background_picture1`, `background_picture2`) VALUES
(1, 'Applying to woods university is easy.', 'Complete an online application.', 'Whether you’re a first-year, transfer, or returning student, there is no fee to apply.', 'Send your official transcripts.', 'After you submit your application, you’ll also need to send us a copy of your transcripts or GED. While we prefer transcripts to be sent electronically, we also accept official documents via postal mail', 'Stay in touch', 'We’ll give you a call, shoot you a text or reach out via email if we’re missing any information. And along the way, if you have any questions, you can always get in touch at 0976206889 or getenrolled@woods.edu.', 'Getting into woods university', 'Reviewing the basic requirements.', 'We look at more than just test scores and GPAs.\r\nAs a test-optional college, we don’t require SAT or ACT scores for admissions. Additionally, we know COVID-19 has impacted students in a variety of ways. Baker College uses a comprehensive application review, meaning we look at you as a whole person with more to offer than a grade point average.', 'Students who have earned a high school diploma or its equivalent, such as a General Education Development (GED) certificate, are eligible to apply.', 'Need more info? We’re here to help?', 'ADMISSION', 'step 1', 'step 2', 'step 3', 'APPLY', 'student_registration.php', 'APPLY', 'student_registration.php', 'Learn More', '#', 'Resources/wall papers/224.jpg', 'Resources/wall papers/224.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admision2`
--

CREATE TABLE `admision2` (
  `admision2_id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `Reading` text DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `buttun` varchar(255) DEFAULT NULL,
  `buttun_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admision2`
--

INSERT INTO `admision2` (`admision2_id`, `icon`, `Reading`, `Content`, `buttun`, `buttun_url`) VALUES
(1, 'fas fa-calendar-check steps', 'Live chat with us', '\r\nOur friendly admissions experts are standing by to answer your questions.', NULL, NULL),
(2, 'fas fa-laptop steps', 'Join us for an admissions event', 'APPLY to attend a special info session just for new students.', 'APPLY', 'student_registration.php'),
(3, 'far fa-address-book steps', 'Submit a contact form', 'Complete the request for information form to have our staff follow up with the info you’re looking for.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admision3`
--

CREATE TABLE `admision3` (
  `admision3_id` bigint(20) UNSIGNED NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `heading_content` text DEFAULT NULL,
  `buttun` varchar(255) DEFAULT NULL,
  `buttun_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admision3`
--

INSERT INTO `admision3` (`admision3_id`, `picture`, `heading`, `heading_content`, `buttun`, `buttun_url`) VALUES
(1, 'Resources/wall papers/225.jpg', 'Adult Learners', 'Even if you have a busy schedule, our flexible hours and convenient online learning options make it easy to achieve your goals.', 'Learn More ', '#'),
(2, 'Resources/wall papers/241.jpg', 'Transfer Students', 'When you transfer to Baker College, we’ll make sure you get maximum credit for the coursework you’ve already completed.', 'Learn More ', '#'),
(3, 'Resources/wall papers/242.jpg', 'Options for Everyone', 'High School Students Small class sizes make it easy to make friends and find study groups. Plus, our student housing options keep you close to helpful resources on campus.', 'Learn More ', '#'),
(4, 'Resources/wall papers/90.jpg', 'Graduate Students', 'We have a wide variety of master’s and doctoral programs that can help you build the knowledge and skills you need to take your career to the next level.', 'Learn More ', '#'),
(5, 'Resources/wall papers/214.jpg', 'Military Members & Families', 'Whether you’re on active duty or making the transition to civilian life, we can help you get a top-quality education at a price you can afford.', 'Learn More ', '#'),
(6, 'Resources/wall papers/229.jpg', 'International Students', 'We’re proud to have a diverse and inclusive campus where students from all over the world can come and join the BakerProud community.', 'Learn More ', '#');

-- --------------------------------------------------------

--
-- Table structure for table `allprograms`
--

CREATE TABLE `allprograms` (
  `allprograms_id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `certification_id` int(11) DEFAULT NULL,
  `years_of_study_id` int(11) DEFAULT NULL,
  `mood_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allprograms`
--

INSERT INTO `allprograms` (`allprograms_id`, `program_id`, `certification_id`, `years_of_study_id`, `mood_id`) VALUES
(1, 1, 1, 1, 4),
(2, 1, 2, 3, 4),
(3, 1, 3, 4, 4),
(4, 1, 4, 4, 4),
(5, 1, 5, 4, 4),
(7, 2, 1, 1, 4),
(8, 2, 2, 3, 4),
(9, 2, 3, 4, 4),
(10, 2, 4, 4, 4),
(11, 2, 5, 4, 4),
(12, 3, 1, 1, 4),
(13, 3, 2, 3, 4),
(14, 3, 3, 4, 4),
(15, 3, 4, 4, 4),
(16, 3, 5, 4, 4),
(17, 4, 1, 1, 5),
(18, 4, 2, 3, 5),
(19, 4, 3, 4, 5),
(20, 4, 4, 4, 5),
(21, 4, 5, 4, 5),
(22, 5, 1, 1, 4),
(23, 5, 2, 3, 4),
(24, 5, 3, 4, 4),
(25, 5, 4, 4, 4),
(26, 5, 5, 4, 4),
(27, 6, 1, 1, 2),
(28, 6, 2, 3, 2),
(29, 6, 3, 4, 2),
(30, 6, 4, 4, 2),
(31, 6, 5, 4, 2),
(32, 7, 1, 1, 2),
(33, 7, 2, 3, 2),
(34, 7, 3, 4, 2),
(35, 7, 4, 4, 2),
(36, 7, 5, 4, 2),
(37, 8, 1, 1, 2),
(38, 8, 2, 3, 2),
(39, 8, 3, 4, 2),
(40, 8, 4, 4, 2),
(41, 8, 5, 4, 2),
(42, 9, 1, 1, 2),
(43, 9, 2, 3, 2),
(44, 9, 3, 4, 2),
(45, 9, 4, 4, 2),
(46, 9, 5, 4, 2),
(47, 10, 1, 1, 2),
(48, 10, 2, 3, 2),
(49, 10, 3, 4, 2),
(50, 10, 4, 4, 2),
(51, 10, 5, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `certification_id` int(11) NOT NULL,
  `certification_name` varchar(255) NOT NULL CHECK (`certification_name` in ('Certificate','Diploma','Degree','Masters','PhD'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`certification_id`, `certification_name`) VALUES
(1, 'Certificate'),
(2, 'Diploma'),
(3, 'Degree'),
(4, 'Masters'),
(5, 'PhD');

-- --------------------------------------------------------

--
-- Table structure for table `copyright`
--

CREATE TABLE `copyright` (
  `copyright_id` int(11) NOT NULL,
  `copyright_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `copyright`
--

INSERT INTO `copyright` (`copyright_id`, `copyright_year`) VALUES
(1, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_code` varchar(255) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_name`) VALUES
('ACC101', 'Introduction to Accounting'),
('ACC102', 'Financial Accounting'),
('ACC103', 'Business Mathematics'),
('ACC104', 'Microeconomics'),
('ACC105', 'Macroeconomics'),
('ACC106', 'Business Communication'),
('ACC107', 'Business Law'),
('ACC108', 'Marketing'),
('ACC201', 'Cost Accounting'),
('ACC202', 'Managerial Accounting'),
('ACC203', 'Financial Management'),
('ACC204', 'Taxation'),
('ACC205', 'Auditing'),
('ACC206', 'Business Statistics'),
('ACC207', 'Human Resource Management'),
('ACC208', 'Operations Management'),
('ACC301', 'Advanced Financial Accounting'),
('ACC302', 'Advanced Managerial Accounting'),
('ACC303', 'Corporate Finance'),
('ACC304', 'International Accounting'),
('ACC305', 'Investment Analysis'),
('ACC306', 'Financial Statement Analysis'),
('ACC307', 'Forensic Accounting'),
('ACC308', 'Accounting Information Systems'),
('ACC401', 'Strategic Management Accounting'),
('ACC402', 'Risk Management'),
('ACC403', 'Accounting Ethics'),
('ACC404', 'Financial Reporting'),
('ACC405', 'Corporate Governance'),
('ACC406', 'Advanced Taxation'),
('ACC407', 'Capstone Project'),
('ACC408', 'Contemporary Issues in Accounting'),
('AGR101', 'Introduction to Agriculture'),
('AGR102', 'Soil Science'),
('AGR103', 'Crop Science'),
('AGR104', 'Animal Science'),
('AGR105', 'Agricultural Economics'),
('AGR106', 'Agribusiness Management'),
('AGR107', 'Agricultural Technology'),
('AGR108', 'Research Methods in Agriculture'),
('AGR201', 'Pest Management'),
('AGR202', 'Agricultural Marketing'),
('AGR203', 'Farm Management'),
('AGR204', 'Agricultural Policy'),
('AGR205', 'Rural Sociology'),
('AGR206', 'Precision Agriculture'),
('AGR207', 'Food Security and Sustainability'),
('AGR208', 'Advanced Topics in Agriculture'),
('AGR301', 'Climate Change and Agriculture'),
('AGR302', 'International Agriculture'),
('AGR303', 'Agricultural Extension'),
('AGR304', 'Livestock Management'),
('AGR305', 'Aquaculture'),
('AGR306', 'Organic Farming'),
('AGR307', 'Research Project in Agriculture'),
('AGR308', 'Advanced Agricultural Elective'),
('AGR401', 'Capstone Project in Agriculture'),
('AGR402', 'Internship in Agriculture'),
('AGR403', 'Agroforestry'),
('AGR404', 'Agricultural Biotechnology'),
('AGR405', 'Urban Agriculture'),
('AGR406', 'Animal Nutrition'),
('AGR407', 'Special Topics in Agriculture'),
('AGR408', 'Advanced Agriculture Elective'),
('APSY401', 'Advanced Developmental Psychology'),
('ARC101', 'Architectural Design Fundamentals'),
('ARC102', 'History of Architecture I'),
('ARC103', 'Architectural Drawing'),
('ARC104', 'Building Materials and Construction'),
('ARC105', 'Architectural Theory'),
('ARC106', 'Structural Systems'),
('ARC107', 'Environmental Systems'),
('ARC108', 'Research Methods in Architecture'),
('ARC201', 'Architectural Design Studio I'),
('ARC202', 'History of Architecture II'),
('ARC203', 'Digital Design and Fabrication'),
('ARC204', 'Architectural Programming'),
('ARC205', 'Urban Design'),
('ARC206', 'Building Technology'),
('ARC207', 'Sustainable Design'),
('ARC208', 'Advanced Topics in Architecture'),
('ARC301', 'Architectural Design Studio II'),
('ARC302', 'Professional Practice'),
('ARC303', 'Landscape Architecture'),
('ARC304', 'Interior Design'),
('ARC305', 'Urban Planning'),
('ARC306', 'Building Conservation'),
('ARC307', 'Research Project in Architecture'),
('ARC308', 'Advanced Architectural Elective'),
('ARC401', 'Capstone Project in Architecture'),
('ARC402', 'Internship in Architecture'),
('ARC403', 'Architecture and Society'),
('ARC404', 'Digital Architecture'),
('ARC405', 'Architectural Acoustics'),
('ARC406', 'Community Design'),
('ARC407', 'Special Topics in Architecture'),
('ARC408', 'Advanced Architecture Elective'),
('ART101', 'Introduction to Art History'),
('ART102', 'World Literature'),
('ART103', 'History of Philosophy'),
('ART104', 'Cultural Anthropology'),
('ART105', 'Music Appreciation'),
('ART106', 'Introduction to Theater'),
('ART107', 'Visual Culture'),
('ART108', 'Research Methods in Arts and Humanities'),
('ART201', 'Renaissance Art'),
('ART202', 'Modern Literature'),
('ART203', 'Ethics and Society'),
('ART204', 'Philosophy of Religion'),
('ART205', 'Contemporary Theater'),
('ART206', 'Critical Theory'),
('ART207', 'Gender Studies in the Arts'),
('ART208', 'History of Ideas'),
('ART301', 'Art and Politics'),
('ART302', 'Literary Theory'),
('ART303', 'Aesthetics'),
('ART304', 'Philosophy of Art'),
('ART305', 'Theater Production'),
('ART306', 'Visual Arts Workshop'),
('ART307', 'Cultural Criticism'),
('ART308', 'Special Topics in Arts and Humanities'),
('ART401', 'Capstone Project in Arts and Humanities'),
('ART402', 'Internship in Arts and Humanities'),
('ART403', 'Arts and Humanities Research Project'),
('ART404', 'Visual Culture Studies'),
('ART405', 'Literature and Society'),
('ART406', 'Performing Arts in Society'),
('ART407', 'Special Topics in Arts and Humanities II'),
('ART408', 'Advanced Arts and Humanities Elective'),
('BA101', 'Introduction to Business'),
('BA102', 'Microeconomics'),
('BA103', 'Business Communication'),
('BA104', 'Financial Accounting'),
('BA105', 'Business Mathematics'),
('BA106', 'Principles of Management'),
('BA107', 'Marketing'),
('BA108', 'Business Law'),
('BA201', 'Macroeconomics'),
('BA202', 'Cost Accounting'),
('BA203', 'Human Resource Management'),
('BA204', 'Business Statistics'),
('BA205', 'Financial Management'),
('BA206', 'Operations Management'),
('BA207', 'Organizational Behavior'),
('BA208', 'Business Ethics'),
('BA301', 'Strategic Management'),
('BA302', 'International Business'),
('BA303', 'Entrepreneurship'),
('BA304', 'Managerial Accounting'),
('BA305', 'Business Research Methods'),
('BA306', 'E-Business'),
('BA307', 'Consumer Behavior'),
('BA308', 'Investment Analysis'),
('BA401', 'Corporate Finance'),
('BA402', 'Leadership'),
('BA403', 'Business Analytics'),
('BA404', 'Supply Chain Management'),
('BA405', 'Negotiation Skills'),
('BA406', 'Project Management'),
('BA407', 'Risk Management'),
('BA408', 'Capstone Project'),
('BIO101', 'Introduction to Biology'),
('BIO102', 'Cell Biology'),
('BIO103', 'Genetics'),
('BIO104', 'Microbiology'),
('BIO105', 'Biochemistry'),
('BIO106', 'Ecology'),
('BIO107', 'Human Anatomy'),
('BIO108', 'Plant Biology'),
('BIO201', 'Molecular Biology'),
('BIO202', 'Immunology'),
('BIO203', 'Developmental Biology'),
('BIO204', 'Evolutionary Biology'),
('BIO205', 'Animal Physiology'),
('BIO206', 'Biostatistics'),
('BIO207', 'Marine Biology'),
('BIO208', 'Botany'),
('BIO301', 'Advanced Genetics'),
('BIO302', 'Bioinformatics'),
('BIO303', 'Biotechnology'),
('BIO304', 'Environmental Biology'),
('BIO305', 'Neuroscience'),
('BIO306', 'Pathology'),
('BIO307', 'Toxicology'),
('BIO308', 'Wildlife Biology'),
('BIO401', 'Advanced Cell Biology'),
('BIO402', 'Genomics'),
('BIO403', 'Proteomics'),
('BIO404', 'Cancer Biology'),
('BIO405', 'Stem Cell Biology'),
('BIO406', 'Advanced Biochemistry'),
('BIO407', 'Capstone Project'),
('BIO408', 'Special Topics in Biology'),
('CHE101', 'General Chemistry I'),
('CHE102', 'General Chemistry II'),
('CHE103', 'Organic Chemistry I'),
('CHE104', 'Inorganic Chemistry I'),
('CHE105', 'Physical Chemistry I'),
('CHE106', 'Analytical Chemistry I'),
('CHE107', 'Biochemistry I'),
('CHE108', 'Laboratory Techniques'),
('CHE201', 'Organic Chemistry II'),
('CHE202', 'Inorganic Chemistry II'),
('CHE203', 'Physical Chemistry II'),
('CHE204', 'Analytical Chemistry II'),
('CHE205', 'Biochemistry II'),
('CHE206', 'Environmental Chemistry'),
('CHE207', 'Industrial Chemistry'),
('CHE208', 'Polymer Chemistry'),
('CHE301', 'Advanced Organic Chemistry'),
('CHE302', 'Advanced Inorganic Chemistry'),
('CHE303', 'Advanced Physical Chemistry'),
('CHE304', 'Advanced Analytical Chemistry'),
('CHE305', 'Advanced Biochemistry'),
('CHE306', 'Materials Chemistry'),
('CHE307', 'Theoretical Chemistry'),
('CHE308', 'Computational Chemistry'),
('CHE401', 'Advanced Environmental Chemistry'),
('CHE402', 'Advanced Polymer Chemistry'),
('CHE403', 'Medicinal Chemistry'),
('CHE404', 'Nanochemistry'),
('CHE405', 'Chemical Kinetics'),
('CHE406', 'Surface Chemistry'),
('CHE407', 'Capstone Project'),
('CHE408', 'Special Topics in Chemistry'),
('COM101', 'Introduction to Communications'),
('COM102', 'Mass Media and Society'),
('COM103', 'Communication Theory'),
('COM104', 'Media Writing'),
('COM105', 'Digital Media Production'),
('COM106', 'Public Relations'),
('COM107', 'Intercultural Communication'),
('COM108', 'Research Methods in Communications'),
('COM201', 'Advertising and Marketing Communications'),
('COM202', 'Visual Communication'),
('COM203', 'Media Law and Ethics'),
('COM204', 'Corporate Communication'),
('COM205', 'Social Media Strategies'),
('COM206', 'Journalism'),
('COM207', 'Film Studies'),
('COM208', 'Strategic Communication Planning'),
('COM301', 'Digital Marketing'),
('COM302', 'Crisis Communication'),
('COM303', 'Media Effects'),
('COM304', 'Political Communication'),
('COM305', 'Health Communication'),
('COM306', 'New Media Technologies'),
('COM307', 'Communication Research Project'),
('COM308', 'Communication Ethics'),
('COM401', 'Capstone Project in Communications'),
('COM402', 'Internship in Communications'),
('COM403', 'Advanced Topics in Communications'),
('COM404', 'Digital Journalism'),
('COM405', 'Global Communication'),
('COM406', 'Media and Cultural Studies'),
('COM407', 'Special Topics in Communications'),
('COM408', 'Advanced Communications Elective'),
('CPSY301', 'Clinical Psychology'),
('CS101', 'Introduction to Computer Science'),
('CS102', 'Programming Fundamentals'),
('CS103', 'Discrete Mathematics'),
('CS104', 'Computer Organization and Architecture'),
('CS105', 'Database Systems'),
('CS106', 'Data Structures and Algorithms'),
('CS107', 'Operating Systems'),
('CS108', 'Software Engineering Principles'),
('CS201', 'Computer Networks'),
('CS202', 'Web Development'),
('CS203', 'Theory of Computation'),
('CS204', 'Algorithm Design and Analysis'),
('CS205', 'Database Management Systems'),
('CS206', 'Operating Systems II'),
('CS207', 'Software Development Practices'),
('CS208', 'Artificial Intelligence'),
('CS301', 'Advanced Programming'),
('CS302', 'Network Security'),
('CS303', 'Mobile App Development'),
('CS304', 'Machine Learning'),
('CS305', 'Data Mining'),
('CS306', 'Human-Computer Interaction'),
('CS307', 'Cloud Computing'),
('CS308', 'Software Project Management'),
('CS401', 'Computer Graphics'),
('CS402', 'Cryptography'),
('CS403', 'Big Data Analytics'),
('CS404', 'Internet of Things'),
('CS405', 'Advanced Algorithms'),
('CS406', 'Cybersecurity'),
('CS407', 'Distributed Systems'),
('CS408', 'Capstone Project'),
('ECO101', 'Introduction to Economics'),
('ECO102', 'Microeconomics'),
('ECO103', 'Macroeconomics'),
('ECO104', 'Mathematics for Economists'),
('ECO105', 'Statistics for Economists'),
('ECO106', 'Economic History'),
('ECO107', 'Development Economics'),
('ECO108', 'Public Economics'),
('ECO201', 'Intermediate Microeconomics'),
('ECO202', 'Intermediate Macroeconomics'),
('ECO203', 'Econometrics'),
('ECO204', 'International Economics'),
('ECO205', 'Monetary Economics'),
('ECO206', 'Labor Economics'),
('ECO207', 'Environmental Economics'),
('ECO208', 'Industrial Organization'),
('ECO301', 'Advanced Microeconomics'),
('ECO302', 'Advanced Macroeconomics'),
('ECO303', 'Advanced Econometrics'),
('ECO304', 'Health Economics'),
('ECO305', 'Behavioral Economics'),
('ECO306', 'Urban Economics'),
('ECO307', 'Game Theory'),
('ECO308', 'Financial Economics'),
('ECO401', 'Economic Policy'),
('ECO402', 'Growth and Development'),
('ECO403', 'International Trade'),
('ECO404', 'Public Finance'),
('ECO405', 'Economics of Regulation'),
('ECO406', 'Experimental Economics'),
('ECO407', 'Economic History II'),
('ECO408', 'Capstone Project'),
('EDU101', 'Foundations of Education'),
('EDU102', 'Educational Psychology'),
('EDU103', 'Curriculum Development'),
('EDU104', 'Instructional Strategies'),
('EDU105', 'Classroom Management'),
('EDU106', 'Assessment and Evaluation in Education'),
('EDU107', 'Diversity in Education'),
('EDU108', 'Introduction to Special Education'),
('EDU201', 'Educational Leadership'),
('EDU202', 'Education Policy'),
('EDU203', 'Technology in Education'),
('EDU204', 'Literacy Instruction'),
('EDU205', 'Multicultural Education'),
('EDU206', 'Child Development and Learning'),
('EDU207', 'Teaching English as a Second Language'),
('EDU208', 'Research Methods in Education'),
('EDU301', 'Special Education Strategies'),
('EDU302', 'Education Law and Ethics'),
('EDU303', 'Educational Assessment'),
('EDU304', 'Counseling in Schools'),
('EDU305', 'Teaching Mathematics'),
('EDU306', 'Instructional Design'),
('EDU307', 'School and Community Partnerships'),
('EDU308', 'Education Research Project'),
('EDU401', 'Capstone Project in Education'),
('EDU402', 'Internship in Education'),
('EDU403', 'Educational Psychology Seminar'),
('EDU404', 'Education Policy Analysis'),
('EDU405', 'Advanced Topics in Education'),
('EDU406', 'Education Technology Integration'),
('EDU407', 'Special Topics in Education'),
('EDU408', 'Advanced Education Elective'),
('ENG101', 'Introduction to Engineering'),
('ENG102', 'Engineering Mathematics'),
('ENG103', 'Engineering Physics'),
('ENG104', 'Engineering Chemistry'),
('ENG105', 'Technical Drawing'),
('ENG106', 'Computer Programming for Engineers'),
('ENG107', 'Mechanics'),
('ENG108', 'Materials Science'),
('ENG201', 'Thermodynamics'),
('ENG202', 'Fluid Mechanics'),
('ENG203', 'Electrical Engineering'),
('ENG204', 'Electronics'),
('ENG205', 'Engineering Design'),
('ENG206', 'Statics and Dynamics'),
('ENG207', 'Control Systems'),
('ENG208', 'Engineering Ethics'),
('ENG301', 'Advanced Mechanics'),
('ENG302', 'Heat Transfer'),
('ENG303', 'Machine Design'),
('ENG304', 'Power Systems'),
('ENG305', 'Manufacturing Processes'),
('ENG306', 'Engineering Management'),
('ENG307', 'Environmental Engineering'),
('ENG308', 'Instrumentation and Measurement'),
('ENG401', 'Renewable Energy Systems'),
('ENG402', 'Robotics'),
('ENG403', 'Project Management'),
('ENG404', 'Advanced Control Systems'),
('ENG405', 'Nanotechnology'),
('ENG406', 'Advanced Manufacturing'),
('ENG407', 'Capstone Project'),
('ENG408', 'Emerging Technologies in Engineering'),
('ENV101', 'Introduction to Environmental Studies'),
('ENV102', 'Ecology'),
('ENV103', 'Environmental Chemistry'),
('ENV104', 'Earth Science'),
('ENV105', 'Climate Change'),
('ENV106', 'Environmental Policy'),
('ENV107', 'Biodiversity'),
('ENV108', 'Environmental Ethics'),
('ENV201', 'Conservation Biology'),
('ENV202', 'Environmental Law'),
('ENV203', 'Sustainable Development'),
('ENV204', 'Environmental Economics'),
('ENV205', 'Water Resources'),
('ENV206', 'Waste Management'),
('ENV207', 'Environmental Impact Assessment'),
('ENV208', 'Energy and Environment'),
('ENV301', 'Advanced Ecology'),
('ENV302', 'Environmental Toxicology'),
('ENV303', 'Geographic Information Systems'),
('ENV304', 'Urban Ecology'),
('ENV305', 'Environmental Monitoring'),
('ENV306', 'Sustainable Agriculture'),
('ENV307', 'Environmental Biotechnology'),
('ENV308', 'Environmental Risk Assessment'),
('ENV401', 'Advanced Conservation Biology'),
('ENV402', 'Advanced Environmental Law'),
('ENV403', 'Global Environmental Issues'),
('ENV404', 'Advanced Environmental Economics'),
('ENV405', 'Restoration Ecology'),
('ENV406', 'Advanced Water Resources'),
('ENV407', 'Capstone Project'),
('ENV408', 'Special Topics in Environmental Studies'),
('FOR101', 'Introduction to Forestry'),
('FOR102', 'Forest Ecology'),
('FOR103', 'Timber Harvesting'),
('FOR104', 'Wildlife Management'),
('FOR105', 'Forest Policy and Administration'),
('FOR106', 'Forest Pathology'),
('FOR107', 'Forest Entomology'),
('FOR108', 'Research Methods in Forestry'),
('FOR201', 'Silviculture'),
('FOR202', 'Forest Economics'),
('FOR203', 'Forest Genetics'),
('FOR204', 'Urban Forestry'),
('FOR205', 'Natural Resource Management'),
('FOR206', 'Forest Inventory'),
('FOR207', 'Climate Change and Forestry'),
('FOR208', 'Advanced Topics in Forestry'),
('FOR301', 'Forest Conservation'),
('FOR302', 'Fire Ecology'),
('FOR303', 'Forest Recreation'),
('FOR304', 'Agroforestry'),
('FOR305', 'Wood Science'),
('FOR306', 'Forest Biotechnology'),
('FOR307', 'Research Project in Forestry'),
('FOR308', 'Advanced Forestry Elective'),
('FOR401', 'Capstone Project in Forestry'),
('FOR402', 'Internship in Forestry'),
('FOR403', 'Forest Policy Analysis'),
('FOR404', 'Forest Health'),
('FOR405', 'Forest Products'),
('FOR406', 'Community Forestry'),
('FOR407', 'Special Topics in Forestry'),
('FOR408', 'Advanced Forestry Elective'),
('HTM101', 'Introduction to Hospitality Management'),
('HTM102', 'Tourism Principles and Practices'),
('HTM103', 'Hotel Operations Management'),
('HTM104', 'Food and Beverage Management'),
('HTM105', 'Travel and Tourism Marketing'),
('HTM106', 'Event Management'),
('HTM107', 'Tourism Economics'),
('HTM108', 'Research Methods in Hospitality and Tourism'),
('HTM201', 'Hospitality Law and Ethics'),
('HTM202', 'Destination Management'),
('HTM203', 'Resort Management'),
('HTM204', 'Hospitality Finance'),
('HTM205', 'Culinary Arts'),
('HTM206', 'Sustainable Tourism'),
('HTM207', 'Convention and Meeting Planning'),
('HTM208', 'Advanced Topics in Hospitality and Tourism'),
('HTM301', 'Strategic Management in Hospitality'),
('HTM302', 'Tourism Policy and Planning'),
('HTM303', 'Global Tourism Issues'),
('HTM304', 'Hospitality Technology'),
('HTM305', 'Restaurant Management'),
('HTM306', 'Tourism and Culture'),
('HTM307', 'Research Project in Hospitality and Tourism'),
('HTM308', 'Advanced Hospitality and Tourism Elective'),
('HTM401', 'Capstone Project in Hospitality and Tourism'),
('HTM402', 'Internship in Hospitality and Tourism'),
('HTM403', 'Hospitality Entrepreneurship'),
('HTM404', 'Tourism and Sustainability'),
('HTM405', 'Cultural Heritage Tourism'),
('HTM406', 'Hospitality and Tourism Marketing Strategies'),
('HTM407', 'Special Topics in Hospitality and Tourism'),
('HTM408', 'Advanced Hospitality and Tourism Elective'),
('IR101', 'Introduction to International Relations'),
('IR102', 'Political Science'),
('IR103', 'World History'),
('IR104', 'Comparative Politics'),
('IR105', 'International Law'),
('IR106', 'International Organizations'),
('IR107', 'Global Economy'),
('IR108', 'Research Methods in International Relations'),
('IR201', 'Foreign Policy Analysis'),
('IR202', 'International Security'),
('IR203', 'Diplomacy'),
('IR204', 'Conflict Resolution'),
('IR205', 'Human Rights'),
('IR206', 'Regional Studies'),
('IR207', 'International Political Economy'),
('IR208', 'International Development'),
('IR301', 'Advanced International Relations Theory'),
('IR302', 'Advanced Comparative Politics'),
('IR303', 'Global Governance'),
('IR304', 'Peace Studies'),
('IR305', 'International Environmental Politics'),
('IR306', 'International Humanitarian Law'),
('IR307', 'International Migration'),
('IR308', 'Non-State Actors in International Relations'),
('IR401', 'Globalization'),
('IR402', 'Advanced Diplomacy'),
('IR403', 'International Negotiations'),
('IR404', 'Advanced Conflict Resolution'),
('IR405', 'International Human Rights Law'),
('IR406', 'Advanced Regional Studies'),
('IR407', 'Capstone Project'),
('IR408', 'Special Topics in International Relations'),
('IT101', 'Introduction to IT'),
('IT102', 'Programming Fundamentals'),
('IT103', 'Computer Organization'),
('IT104', 'Web Technologies'),
('IT105', 'Database Systems'),
('IT106', 'Networking Basics'),
('IT107', 'Operating Systems'),
('IT108', 'IT Project Management'),
('IT201', 'Information Security'),
('IT202', 'Advanced Programming'),
('IT203', 'Systems Analysis and Design'),
('IT204', 'Mobile Application Development'),
('IT205', 'Network Administration'),
('IT206', 'Database Management'),
('IT207', 'Web Development'),
('IT208', 'Cloud Computing'),
('IT301', 'Data Structures and Algorithms'),
('IT302', 'Cybersecurity'),
('IT303', 'Software Development'),
('IT304', 'Artificial Intelligence'),
('IT305', 'Internet of Things'),
('IT306', 'E-Commerce'),
('IT307', 'Digital Forensics'),
('IT308', 'Advanced Database Systems'),
('IT401', 'Big Data Analytics'),
('IT402', 'Network Security'),
('IT403', 'Advanced Web Technologies'),
('IT404', 'Data Mining'),
('IT405', 'Human-Computer Interaction'),
('IT406', 'Cloud Security'),
('IT407', 'Project Management in IT'),
('IT408', 'Capstone Project'),
('LAW101', 'Introduction to Law'),
('LAW102', 'Legal Research and Writing'),
('LAW103', 'Constitutional Law'),
('LAW104', 'Contracts'),
('LAW105', 'Torts'),
('LAW106', 'Criminal Law'),
('LAW107', 'Property Law'),
('LAW108', 'Civil Procedure'),
('LAW201', 'Legal Ethics'),
('LAW202', 'Administrative Law'),
('LAW203', 'Evidence'),
('LAW204', 'Corporate Law'),
('LAW205', 'Family Law'),
('LAW206', 'International Law'),
('LAW207', 'Environmental Law'),
('LAW208', 'Law and Technology'),
('LAW301', 'Human Rights Law'),
('LAW302', 'Labor and Employment Law'),
('LAW303', 'Intellectual Property Law'),
('LAW304', 'Health Law'),
('LAW305', 'Tax Law'),
('LAW306', 'Alternative Dispute Resolution'),
('LAW307', 'Criminal Procedure'),
('LAW308', 'Advanced Legal Writing and Research'),
('LAW401', 'Advanced Topics in Law'),
('LAW402', 'Capstone Project in Law'),
('LAW403', 'Legal Internship'),
('LAW404', 'Law and Society'),
('LAW405', 'Moot Court'),
('LAW406', 'Legal Clinic'),
('LAW407', 'Special Topics in Law'),
('LAW408', 'Advanced Law Elective'),
('LIN101', 'Introduction to Linguistics'),
('LIN102', 'Phonetics and Phonology'),
('LIN103', 'Morphology and Syntax'),
('LIN104', 'Semantics and Pragmatics'),
('LIN105', 'Psycholinguistics'),
('LIN106', 'Sociolinguistics'),
('LIN107', 'Language Acquisition'),
('LIN108', 'Research Methods in Linguistics'),
('LIN201', 'Computational Linguistics'),
('LIN202', 'Historical Linguistics'),
('LIN203', 'Applied Linguistics'),
('LIN204', 'Language and Cognition'),
('LIN205', 'Discourse Analysis'),
('LIN206', 'Bilingualism and Multilingualism'),
('LIN207', 'Language and Culture'),
('LIN208', 'Field Linguistics'),
('LIN301', 'Pragmatics'),
('LIN302', 'Language Documentation'),
('LIN303', 'Language Revitalization'),
('LIN304', 'Neurolinguistics'),
('LIN305', 'Experimental Phonetics'),
('LIN306', 'Language Policy and Planning'),
('LIN307', 'Language Teaching Methodology'),
('LIN308', 'Advanced Topics in Linguistics'),
('LIN401', 'Capstone Project in Linguistics'),
('LIN402', 'Internship in Linguistics'),
('LIN403', 'Linguistics and Society'),
('LIN404', 'Linguistics Research Project'),
('LIN405', 'Advanced Phonology'),
('LIN406', 'Language Contact and Change'),
('LIN407', 'Special Topics in Linguistics'),
('LIN408', 'Advanced Linguistics Elective'),
('MATH101', 'Calculus I'),
('MATH102', 'Linear Algebra'),
('MATH103', 'Discrete Mathematics'),
('MATH104', 'Probability and Statistics'),
('MATH105', 'Mathematical Logic'),
('MATH106', 'Number Theory'),
('MATH107', 'Geometry'),
('MATH108', 'Introduction to Programming'),
('MATH201', 'Calculus II'),
('MATH202', 'Abstract Algebra'),
('MATH203', 'Differential Equations'),
('MATH204', 'Numerical Methods'),
('MATH205', 'Mathematical Analysis'),
('MATH206', 'Complex Variables'),
('MATH207', 'Topology'),
('MATH208', 'Mathematical Modeling'),
('MATH301', 'Real Analysis'),
('MATH302', 'Functional Analysis'),
('MATH303', 'Partial Differential Equations'),
('MATH304', 'Applied Mathematics'),
('MATH305', 'Mathematical Physics'),
('MATH306', 'Statistical Inference'),
('MATH307', 'Optimization'),
('MATH308', 'Stochastic Processes'),
('MATH401', 'Advanced Calculus'),
('MATH402', 'Advanced Linear Algebra'),
('MATH403', 'Advanced Differential Equations'),
('MATH404', 'Mathematical Statistics'),
('MATH405', 'Advanced Numerical Methods'),
('MATH406', 'Mathematical Finance'),
('MATH407', 'Capstone Project'),
('MATH408', 'Special Topics in Mathematics'),
('MUS101', 'Music Theory I'),
('MUS102', 'Music History I'),
('MUS103', 'Ear Training and Sight Singing I'),
('MUS104', 'Keyboard Harmony'),
('MUS105', 'Applied Music Lessons I'),
('MUS106', 'Choral Techniques'),
('MUS107', 'Instrumental Techniques'),
('MUS108', 'Introduction to Music Technology'),
('MUS201', 'Music Theory II'),
('MUS202', 'Music History II'),
('MUS203', 'Ear Training and Sight Singing II'),
('MUS204', 'Conducting'),
('MUS205', 'Applied Music Lessons II'),
('MUS206', 'Chamber Music'),
('MUS207', 'Music Composition'),
('MUS208', 'Music and Media'),
('MUS301', 'Orchestration'),
('MUS302', 'Jazz Studies'),
('MUS303', 'Music Education'),
('MUS304', 'Music Therapy'),
('MUS305', 'Ethnomusicology'),
('MUS306', 'Advanced Music Technology'),
('MUS307', 'Music Business and Entrepreneurship'),
('MUS308', 'Research Methods in Music'),
('MUS401', 'Capstone Project in Music'),
('MUS402', 'Internship in Music'),
('MUS403', 'Music and Culture'),
('MUS404', 'Music Production Techniques'),
('MUS405', 'Music Ensemble'),
('MUS406', 'Music Performance'),
('MUS407', 'Special Topics in Music'),
('MUS408', 'Advanced Music Elective'),
('NUR101', 'Introduction to Nursing'),
('NUR102', 'Anatomy and Physiology'),
('NUR103', 'Microbiology for Nurses'),
('NUR104', 'Pharmacology'),
('NUR105', 'Nutrition and Dietetics'),
('NUR106', 'Psychology for Nurses'),
('NUR107', 'Nursing Ethics'),
('NUR108', 'Basic Nursing Skills'),
('NUR201', 'Medical-Surgical Nursing'),
('NUR202', 'Pediatric Nursing'),
('NUR203', 'Maternity Nursing'),
('NUR204', 'Mental Health Nursing'),
('NUR205', 'Community Health Nursing'),
('NUR206', 'Pathophysiology'),
('NUR207', 'Health Assessment'),
('NUR208', 'Nursing Research'),
('NUR301', 'Advanced Medical-Surgical Nursing'),
('NUR302', 'Advanced Pediatric Nursing'),
('NUR303', 'Advanced Maternity Nursing'),
('NUR304', 'Advanced Mental Health Nursing'),
('NUR305', 'Advanced Community Health Nursing'),
('NUR306', 'Nursing Leadership and Management'),
('NUR307', 'Nursing Informatics'),
('NUR308', 'Evidence-Based Practice in Nursing'),
('NUR401', 'Advanced Pathophysiology'),
('NUR402', 'Advanced Health Assessment'),
('NUR403', 'Advanced Pharmacology'),
('NUR404', 'Advanced Nutrition and Dietetics'),
('NUR405', 'Advanced Nursing Ethics'),
('NUR406', 'Advanced Nursing Leadership and Management'),
('NUR407', 'Capstone Project'),
('NUR408', 'Special Topics in Nursing'),
('PFA101', 'Acting Fundamentals'),
('PFA102', 'Theater History I'),
('PFA103', 'Voice and Movement'),
('PFA104', 'Stagecraft'),
('PFA105', 'Dance Technique'),
('PFA106', 'Music for Theater'),
('PFA107', 'Directing Basics'),
('PFA108', 'Research Methods in Performing Arts'),
('PFA201', 'Advanced Acting'),
('PFA202', 'Modern Theater'),
('PFA203', 'Playwriting'),
('PFA204', 'Movement Studies'),
('PFA205', 'Musical Theater'),
('PFA206', 'Performance Art'),
('PFA207', 'Theater Production'),
('PFA208', 'Performance Analysis'),
('PFA301', 'Acting for Camera'),
('PFA302', 'Theater and Society'),
('PFA303', 'Improvisational Theater'),
('PFA304', 'Costume Design'),
('PFA305', 'Physical Theater'),
('PFA306', 'Theater Management'),
('PFA307', 'Directing Workshop'),
('PFA308', 'Advanced Topics in Performing Arts'),
('PFA401', 'Capstone Project in Performing Arts'),
('PFA402', 'Internship in Performing Arts'),
('PFA403', 'Performing Arts Research Project'),
('PFA404', 'Theater and Technology'),
('PFA405', 'Global Perspectives in Performance'),
('PFA406', 'Dramaturgy'),
('PFA407', 'Special Topics in Performing Arts'),
('PFA408', 'Advanced Performing Arts Elective'),
('PHA101', 'Introduction to Pharmacy'),
('PHA102', 'Pharmaceutical Chemistry'),
('PHA103', 'Pharmacognosy'),
('PHA104', 'Anatomy and Physiology'),
('PHA105', 'Pharmacy Practice I'),
('PHA106', 'Biochemistry for Pharmacists'),
('PHA107', 'Biostatistics'),
('PHA108', 'Introduction to Drug Regulation'),
('PHA201', 'Pharmacology I'),
('PHA202', 'Pharmacotherapy I'),
('PHA203', 'Pathophysiology for Pharmacists'),
('PHA204', 'Pharmacy Practice II'),
('PHA205', 'Pharmaceutical Microbiology'),
('PHA206', 'Clinical Pharmacokinetics'),
('PHA207', 'Pharmaceutical Biotechnology'),
('PHA208', 'Pharmacy Management and Administration'),
('PHA301', 'Pharmacology II'),
('PHA302', 'Pharmacotherapy II'),
('PHA303', 'Clinical Pharmacy I'),
('PHA304', 'Pharmacy Informatics'),
('PHA305', 'Pharmaceutical Care Practice'),
('PHA306', 'Clinical Toxicology'),
('PHA307', 'Evidence-Based Pharmacy Practice'),
('PHA308', 'Pharmacy Law and Ethics'),
('PHA401', 'Advanced Pharmacotherapy'),
('PHA402', 'Clinical Pharmacy II'),
('PHA403', 'Pharmacy Practice Research'),
('PHA404', 'Pharmacy Internship'),
('PHA405', 'Pharmacy Practice Management'),
('PHA406', 'Capstone Project in Pharmacy'),
('PHA407', 'Special Topics in Pharmacy'),
('PHA408', 'Advanced Pharmacy Elective'),
('PHY101', 'General Physics I'),
('PHY102', 'General Physics II'),
('PHY103', 'Mechanics'),
('PHY104', 'Electricity and Magnetism'),
('PHY105', 'Thermodynamics'),
('PHY106', 'Optics'),
('PHY107', 'Modern Physics'),
('PHY108', 'Experimental Physics'),
('PHY201', 'Classical Mechanics'),
('PHY202', 'Electromagnetism'),
('PHY203', 'Quantum Mechanics'),
('PHY204', 'Statistical Mechanics'),
('PHY205', 'Solid State Physics'),
('PHY206', 'Nuclear Physics'),
('PHY207', 'Astrophysics'),
('PHY208', 'Mathematical Methods for Physicists'),
('PHY301', 'Advanced Quantum Mechanics'),
('PHY302', 'Advanced Electromagnetism'),
('PHY303', 'Advanced Statistical Mechanics'),
('PHY304', 'Particle Physics'),
('PHY305', 'Condensed Matter Physics'),
('PHY306', 'Plasma Physics'),
('PHY307', 'Computational Physics'),
('PHY308', 'Experimental Techniques in Physics'),
('PHY401', 'General Relativity'),
('PHY402', 'Quantum Field Theory'),
('PHY403', 'Advanced Astrophysics'),
('PHY404', 'Advanced Condensed Matter Physics'),
('PHY405', 'Nonlinear Dynamics'),
('PHY406', 'Advanced Plasma Physics'),
('PHY407', 'Capstone Project'),
('PHY408', 'Special Topics in Physics'),
('PSY101', 'Introduction to Psychology'),
('PSY102', 'Developmental Psychology'),
('PSY103', 'Social Psychology'),
('PSY104', 'Cognitive Psychology'),
('PSY105', 'Biological Psychology'),
('PSY106', 'Personality Psychology'),
('PSY107', 'Research Methods in Psychology'),
('PSY108', 'Statistics for Psychology'),
('PSY201', 'Abnormal Psychology'),
('PSY202', 'Health Psychology'),
('PSY203', 'Educational Psychology'),
('PSY204', 'Industrial-Organizational Psychology'),
('PSY205', 'Psychometrics'),
('PSY206', 'Neuropsychology'),
('PSY207', 'Forensic Psychology'),
('PSY208', 'Counseling Psychology'),
('PSY302', 'Positive Psychology'),
('PSY303', 'Advanced Cognitive Psychology'),
('PSY304', 'Psychopharmacology'),
('PSY305', 'Advanced Research Methods'),
('PSY306', 'Cultural Psychology'),
('PSY307', 'Advanced Statistics for Psychology'),
('PSY308', 'Human Factors Psychology'),
('PSY402', 'Advanced Social Psychology'),
('PSY403', 'Advanced Biological Psychology'),
('PSY404', 'Advanced Personality Psychology'),
('PSY405', 'Advanced Health Psychology'),
('PSY406', 'Advanced Clinical Psychology'),
('PSY407', 'Capstone Project'),
('PSY408', 'Special Topics in Psychology'),
('PUB101', 'Introduction to Public Health'),
('PUB102', 'Epidemiology'),
('PUB103', 'Biostatistics'),
('PUB104', 'Health Policy and Management'),
('PUB105', 'Environmental Health'),
('PUB106', 'Social and Behavioral Aspects of Health'),
('PUB107', 'Global Health Issues'),
('PUB108', 'Public Health Ethics'),
('PUB201', 'Health Promotion and Education'),
('PUB202', 'Public Health Nutrition'),
('PUB203', 'Maternal and Child Health'),
('PUB204', 'Infectious Disease Epidemiology'),
('PUB205', 'Chronic Disease Epidemiology'),
('PUB206', 'Healthcare Systems and Policy'),
('PUB207', 'Emergency Preparedness and Response'),
('PUB208', 'Research Methods in Public Health'),
('PUB301', 'Occupational Health and Safety'),
('PUB302', 'Mental Health and Behavioral Health'),
('PUB303', 'Community Health Assessment'),
('PUB304', 'Health Disparities'),
('PUB305', 'Program Planning and Evaluation'),
('PUB306', 'Public Health Law and Ethics'),
('PUB307', 'Health Informatics'),
('PUB308', 'Health Economics'),
('PUB401', 'Global Health Diplomacy'),
('PUB402', 'Capstone Project in Public Health'),
('PUB403', 'Internship in Public Health'),
('PUB404', 'Public Health Leadership'),
('PUB405', 'Health Communication'),
('PUB406', 'Public Health Research'),
('PUB407', 'Special Topics in Public Health'),
('PUB408', 'Advanced Public Health Elective'),
('SOC101', 'Introduction to Sociology'),
('SOC102', 'Anthropology'),
('SOC103', 'Political Science'),
('SOC104', 'Economics'),
('SOC105', 'Social Work'),
('SOC106', 'Cultural Studies'),
('SOC107', 'Research Methods in Social Sciences'),
('SOC108', 'Statistics for Social Sciences'),
('SOC201', 'Gender Studies'),
('SOC202', 'Social Policy'),
('SOC203', 'Urban Sociology'),
('SOC204', 'Globalization and Society'),
('SOC205', 'Race and Ethnicity'),
('SOC206', 'Social Movements'),
('SOC207', 'Environmental Sociology'),
('SOC208', 'Qualitative Research Methods'),
('SOC301', 'Criminology'),
('SOC302', 'Family Studies'),
('SOC303', 'Media and Society'),
('SOC304', 'Social Change'),
('SOC305', 'Health and Society'),
('SOC306', 'Social Theory'),
('SOC307', 'Community Development'),
('SOC308', 'Public Sociology'),
('SOC401', 'Capstone Project in Social Sciences'),
('SOC402', 'Internship in Social Sciences'),
('SOC403', 'Social Sciences Ethics and Professional Issues'),
('SOC404', 'Social Research Project'),
('SOC405', 'Advanced Topics in Social Sciences'),
('SOC406', 'Social Sciences Seminar'),
('SOC407', 'Special Topics in Social Sciences'),
('SOC408', 'Advanced Social Sciences Elective'),
('SPS101', 'Introduction to Sports Science'),
('SPS102', 'Anatomy and Physiology'),
('SPS103', 'Biomechanics'),
('SPS104', 'Exercise Physiology'),
('SPS105', 'Sports Psychology'),
('SPS106', 'Nutrition for Sports Performance'),
('SPS107', 'Sports Medicine'),
('SPS108', 'Research Methods in Sports and Exercise Science'),
('SPS201', 'Strength and Conditioning'),
('SPS202', 'Sport and Exercise Biomechanics'),
('SPS203', 'Motor Learning and Control'),
('SPS204', 'Exercise Prescription'),
('SPS205', 'Injury Prevention and Rehabilitation'),
('SPS206', 'Sports Performance Analysis'),
('SPS207', 'Physical Activity and Health'),
('SPS208', 'Advanced Topics in Sports and Exercise Science'),
('SPS301', 'Exercise Immunology'),
('SPS302', 'Sport Nutrition'),
('SPS303', 'Athlete Monitoring'),
('SPS304', 'Sports Biomechanics'),
('SPS305', 'Exercise Psychology'),
('SPS306', 'Sports Management'),
('SPS307', 'Research Project in Sports and Exercise Science'),
('SPS308', 'Advanced Sports and Exercise Science Elective'),
('SPS401', 'Capstone Project in Sports and Exercise Science'),
('SPS402', 'Internship in Sports and Exercise Science'),
('SPS403', 'Sports Medicine Research'),
('SPS404', 'High Performance Coaching'),
('SPS405', 'Sports Technology'),
('SPS406', 'Exercise and Mental Health'),
('SPS407', 'Special Topics in Sports and Exercise Science'),
('SPS408', 'Advanced Sports and Exercise Science Elective'),
('URP101', 'Introduction to Urban Planning'),
('URP102', 'Urbanization and Development'),
('URP103', 'Urban Design Principles'),
('URP104', 'Environmental Planning'),
('URP105', 'Transportation Planning'),
('URP106', 'Land Use Planning'),
('URP107', 'Geographic Information Systems'),
('URP108', 'Research Methods in Urban Planning'),
('URP201', 'Urban Policy'),
('URP202', 'Community Development'),
('URP203', 'Housing and Real Estate'),
('URP204', 'Urban Infrastructure'),
('URP205', 'Sustainable Development'),
('URP206', 'Economic Planning'),
('URP207', 'Social and Cultural Issues in Urban Planning'),
('URP208', 'Advanced Topics in Urban Planning'),
('URP301', 'Transportation Systems Planning'),
('URP302', 'Urban Governance'),
('URP303', 'Urban Ecology'),
('URP304', 'Regional Planning'),
('URP305', 'Climate Change and Urban Resilience'),
('URP306', 'Public Space Design'),
('URP307', 'Research Project in Urban Planning'),
('URP308', 'Advanced Urban Planning Elective'),
('URP401', 'Capstone Project in Urban Planning'),
('URP402', 'Internship in Urban Planning'),
('URP403', 'Urban Revitalization'),
('URP404', 'Smart Cities'),
('URP405', 'Urban Design and Social Justice'),
('URP406', 'Transportation and Land Use'),
('URP407', 'Special Topics in Urban Planning'),
('URP408', 'Advanced Urban Planning Elective'),
('VART101', 'Drawing Foundations'),
('VART102', 'Color Theory'),
('VART103', 'Art History I'),
('VART104', 'Visual Design'),
('VART105', 'Digital Imaging'),
('VART106', 'Sculpture Techniques'),
('VART107', 'Painting Fundamentals'),
('VART108', 'Research Methods in Visual Arts'),
('VART201', 'Advanced Drawing'),
('VART202', 'Contemporary Art Theory'),
('VART203', 'Photography'),
('VART204', 'Printmaking'),
('VART205', 'Visual Narrative'),
('VART206', 'Public Art'),
('VART207', 'Art Criticism'),
('VART208', 'Visual Culture and Society'),
('VART301', 'Installation Art'),
('VART302', 'Digital Arts'),
('VART303', 'Environmental Art'),
('VART304', 'Exhibition Design'),
('VART305', 'Community Arts'),
('VART306', 'Artistic Entrepreneurship'),
('VART307', 'Visual Arts Research Project'),
('VART308', 'Advanced Topics in Visual Arts'),
('VART401', 'Capstone Project in Visual Arts'),
('VART402', 'Internship in Visual Arts'),
('VART403', 'Visual Arts and Society'),
('VART404', 'Visual Culture Studies'),
('VART405', 'Art and Technology'),
('VART406', 'Curatorial Practices'),
('VART407', 'Special Topics in Visual Arts'),
('VART408', 'Advanced Visual Arts Elective');

-- --------------------------------------------------------

--
-- Table structure for table `cumpus_housing`
--

CREATE TABLE `cumpus_housing` (
  `cumpus_housing_id` int(11) NOT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `heading1` varchar(255) DEFAULT NULL,
  `heading1_content` text DEFAULT NULL,
  `heading2` varchar(255) DEFAULT NULL,
  `heading2_content` text DEFAULT NULL,
  `heading3` varchar(255) DEFAULT NULL,
  `heading3_content` text DEFAULT NULL,
  `heading4` varchar(255) DEFAULT NULL,
  `heading4_content` text DEFAULT NULL,
  `heading5` varchar(255) DEFAULT NULL,
  `background_pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cumpus_housing`
--

INSERT INTO `cumpus_housing` (`cumpus_housing_id`, `tittle`, `heading1`, `heading1_content`, `heading2`, `heading2_content`, `heading3`, `heading3_content`, `heading4`, `heading4_content`, `heading5`, `background_pic`) VALUES
(1, 'cumpus & housing', 'Make yourself at home. No commuting required.', 'Living in student housing can make your college experience even better. With easy access to your classes and on campus activities, you’ll be able to meet new people and form friendships all in a supportive, community-oriented atmosphere', 'Type of housing available', 'Student housing at woods university vary by campus. Accommodations include spacioussuites, apartments, or townhouses. Some facilities are located on campus and others arelocated within the community. Enjoy increased independence and responsibility in acomfortable, safe living environment.', 'Housing cost per semester', 'The current per student rate for all housing options is $2,300 per semester.\r\n\r\nReturning Residence Hall students-A non-refundable $100 pre-payment is required for each semester a student returns to housing due when the Residence Hall Application is submitted. The $100.00 pre-payment is applied toward housing costs each semester it is paid.', 'Student eligibility', 'Students eligible to live in Residence Halls are required to be registered as full-time students. Priority is given to students enrolled in on-campus programs. Returning students have the first opportunity for room selection for the following academic year. All students must be under 25 years old to be eligible for housing', 'Here’s what you should bring to campus', 'Resources/wall papers/163.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cumpus_housing_heading_list`
--

CREATE TABLE `cumpus_housing_heading_list` (
  `heading_list_id` int(11) NOT NULL,
  `heading_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cumpus_housing_heading_list`
--

INSERT INTO `cumpus_housing_heading_list` (`heading_list_id`, `heading_name`) VALUES
(1, 'The basics'),
(2, 'Electronics & Housewares'),
(3, 'Bed & Bath'),
(4, 'Laundry & Cleaning');

-- --------------------------------------------------------

--
-- Table structure for table `cumpus_housing_lists`
--

CREATE TABLE `cumpus_housing_lists` (
  `cumpus_housing_lists_id` int(11) NOT NULL,
  `heading_list_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cumpus_housing_lists`
--

INSERT INTO `cumpus_housing_lists` (`cumpus_housing_lists_id`, `heading_list_id`, `item_name`) VALUES
(1, 1, 'item'),
(2, 1, 'item'),
(3, 1, 'item'),
(4, 1, 'item'),
(5, 2, 'item2'),
(6, 2, 'item2'),
(7, 2, 'item2'),
(8, 2, 'item2'),
(9, 3, 'item3'),
(10, 3, 'item3'),
(11, 3, 'item3'),
(12, 3, 'item3'),
(13, 4, 'ittem4'),
(14, 4, 'ittem4'),
(15, 4, 'ittem4'),
(16, 4, 'ittem4');

-- --------------------------------------------------------

--
-- Table structure for table `cumpus_housing_nav_links`
--

CREATE TABLE `cumpus_housing_nav_links` (
  `cumpus_housing_nav_links_id` bigint(20) UNSIGNED NOT NULL,
  `nav_link_name` varchar(255) DEFAULT NULL,
  `nav_link_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cumpus_housing_nav_links`
--

INSERT INTO `cumpus_housing_nav_links` (`cumpus_housing_nav_links_id`, `nav_link_name`, `nav_link_url`) VALUES
(1, 'Programs', 'Programspage.php'),
(2, 'Admission', 'admision.php'),
(3, 'fees & final-aid', 'fees_and_finicial_aid.php'),
(4, 'cumpus & housing', 'cumpus_and_housing.php');

-- --------------------------------------------------------

--
-- Table structure for table `cumpus_housing_slides_images`
--

CREATE TABLE `cumpus_housing_slides_images` (
  `cumpus_housing_slides_images_id` int(11) NOT NULL,
  `link_name` varchar(255) DEFAULT NULL,
  `link_url` varchar(255) NOT NULL,
  `picture1` varchar(255) DEFAULT NULL,
  `picture2` varchar(255) DEFAULT NULL,
  `picture3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cumpus_housing_slides_images`
--

INSERT INTO `cumpus_housing_slides_images` (`cumpus_housing_slides_images_id`, `link_name`, `link_url`, `picture1`, `picture2`, `picture3`) VALUES
(1, 'Classes', '#', 'Resources/wall papers/164.jpg', 'Resources/wall papers/238.jpg', 'Resources/wall papers/241.jpg'),
(2, 'Housing', '#', 'Resources/wall papers/156.jpg', 'Resources/wall papers/244.jpg', 'Resources/wall papers/245.jpg'),
(3, '  Canteen', '#', 'Resources/wall papers/198.jpg', 'Resources/wall papers/158.jpg', 'Resources/wall papers/220.jpg'),
(4, 'Library', '#', 'Resources/wall papers/157.jpg', 'Resources/wall papers/109.jpg', 'Resources/wall papers/107.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'Computer Science and Information Technology'),
(2, 'Business and Economics'),
(3, 'Engineering'),
(4, 'Natural Sciences'),
(5, 'Health Sciences'),
(6, 'Social Sciences and Humanities'),
(7, 'Arts and Design'),
(8, 'Agriculture and Forestry'),
(9, 'Architecture and Urban Planning'),
(10, 'Hospitality and Tourism');

-- --------------------------------------------------------

--
-- Table structure for table `fees_and_finicial_aid_2`
--

CREATE TABLE `fees_and_finicial_aid_2` (
  `fees_and_finicial_aid_2_id` bigint(20) UNSIGNED NOT NULL,
  `heading3` varchar(255) DEFAULT NULL,
  `heading3_content` text DEFAULT NULL,
  `buttun2` varchar(255) DEFAULT NULL,
  `buttun2_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_and_finicial_aid_2`
--

INSERT INTO `fees_and_finicial_aid_2` (`fees_and_finicial_aid_2_id`, `heading3`, `heading3_content`, `buttun2`, `buttun2_url`) VALUES
(1, 'Scholarships', 'Students have a wide variety of scholarship opportunities available to them through Baker College, local organizations, and more.', 'Learn More', '#'),
(2, 'Tuition', 'Investing in education is an investment in your future. Making that investment attainable is one of our top priorities.', 'Learn More', '#'),
(3, 'Grants', 'You may be eligible for financial aid through grants offered by the federal government, state government, private organizations, and through Baker College.more.', 'Learn More', '#'),
(4, 'Financial Aid', 'A great education might be more affordable than you think. Work with our advisors to find financial aid opportunities you qualify for.', 'Learn More', '#'),
(5, 'Loans', 'We work with the Governmental Direct Loan Program to offer low-interest loans to qualified students and their parents.\r\n', 'Learn More', '#'),
(6, 'Military & Organizational', 'If you’re currently serving in the military, have served on active duty, or are the spouse or child of someone serving on active duty, you could get help paying for school.\r\n', 'Learn More', '#');

-- --------------------------------------------------------

--
-- Table structure for table `fees_and_finicial_aid_admin`
--

CREATE TABLE `fees_and_finicial_aid_admin` (
  `fees_and_finicial_aid_admin_id` bigint(20) UNSIGNED NOT NULL,
  `heading1` varchar(255) DEFAULT NULL,
  `heading1_content` text DEFAULT NULL,
  `heading2` varchar(255) DEFAULT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `buttun1` varchar(255) DEFAULT NULL,
  `buttun1_url` varchar(255) DEFAULT NULL,
  `background_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees_and_finicial_aid_admin`
--

INSERT INTO `fees_and_finicial_aid_admin` (`fees_and_finicial_aid_admin_id`, `heading1`, `heading1_content`, `heading2`, `tittle`, `buttun1`, `buttun1_url`, `background_pic`) VALUES
(1, 'Quality education should be accessible. We can help.', 'College is an investment in your future. Whether you are looking to take the first steps in your career path as a first-time student, looking to transfer from another institution, need technical training, or an advanced degree, Baker College is committed to making your investment affordable. As a nonprofit institution, we invest in our students, not shareholders.\r\n\r\nThrough the combination of scholarships, grants, and financial aid, your admission advisor can help you. You will quickly realize that Baker College can offer some of the lowest tuition of any private college in Michigan, often with more financial help than most community colleges and public universities.', 'Applying to woods university is easy.', 'FEES AND FININCIAL AID', 'APPLY', 'student_registration.php', 'Resources/wall papers/237.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `footer_lists`
--

CREATE TABLE `footer_lists` (
  `footer_lists_id` int(11) NOT NULL,
  `list_heading_id` int(11) DEFAULT NULL,
  `list_item_name` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `footer_lists`
--

INSERT INTO `footer_lists` (`footer_lists_id`, `list_heading_id`, `list_item_name`, `button_url`) VALUES
(1, 1, 'About wooods', '#'),
(2, 1, 'Bookstore', '#'),
(3, 2, 'Staff', '#'),
(4, 2, 'Give to Baylor', '#'),
(5, 3, 'Legal Disclosure', '#'),
(6, 3, 'Resources', '#'),
(7, 4, 'Admissions', '#'),
(8, 4, 'Safety and Security', '#'),
(9, 4, 'Web Accessibility', '#');

-- --------------------------------------------------------

--
-- Table structure for table `footer_list_heading`
--

CREATE TABLE `footer_list_heading` (
  `list_heading_id` int(11) NOT NULL,
  `heading_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `footer_list_heading`
--

INSERT INTO `footer_list_heading` (`list_heading_id`, `heading_name`) VALUES
(1, 'Athletics'),
(2, 'Give Light'),
(3, 'Attendance Cost'),
(4, 'general information');

-- --------------------------------------------------------

--
-- Table structure for table `home_nav`
--

CREATE TABLE `home_nav` (
  `home_nav_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_nav`
--

INSERT INTO `home_nav` (`home_nav_id`, `name`, `name_url`) VALUES
(1, 'HOME', 'index.php'),
(2, 'PROGRAMS ', 'program_list.php'),
(3, 'libray ', 'library.php'),
(4, 'MORE INFORMATION', 'Programspage.php');

-- --------------------------------------------------------

--
-- Table structure for table `home_page`
--

CREATE TABLE `home_page` (
  `home_page_id` bigint(20) UNSIGNED NOT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `tittle_content` text DEFAULT NULL,
  `heading1` varchar(255) DEFAULT NULL,
  `heading1_content` text DEFAULT NULL,
  `heading2` varchar(255) DEFAULT NULL,
  `heading2_content` text DEFAULT NULL,
  `heading3` varchar(255) DEFAULT NULL,
  `heading3_content` text DEFAULT NULL,
  `heading3_sub_content` text DEFAULT NULL,
  `heading4` varchar(255) DEFAULT NULL,
  `button1` varchar(255) DEFAULT NULL,
  `button2` varchar(255) DEFAULT NULL,
  `button2_url` varchar(255) DEFAULT NULL,
  `button3` varchar(255) DEFAULT NULL,
  `button3_url` varchar(255) DEFAULT NULL,
  `button4` varchar(255) DEFAULT NULL,
  `button4_url` varchar(255) DEFAULT NULL,
  `background_picture1` varchar(255) DEFAULT NULL,
  `picture1` varchar(255) NOT NULL,
  `background_picture2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_page`
--

INSERT INTO `home_page` (`home_page_id`, `tittle`, `tittle_content`, `heading1`, `heading1_content`, `heading2`, `heading2_content`, `heading3`, `heading3_content`, `heading3_sub_content`, `heading4`, `button1`, `button2`, `button2_url`, `button3`, `button3_url`, `button4`, `button4_url`, `background_picture1`, `picture1`, `background_picture2`) VALUES
(1, 'WOODS UNIVERSITY', 'Master essential skills that improve your carear via interactive learning.', 'ABOUT WOODS UNIVERSITY', 'Developing passion for learning. You will never cease to grow and woods has a role in both advancing research and educating the next generation of leaders to succeed in and shape the digital economy.', 'WOODS UNIVERSITY', 'Developing passion for learning. You will never cease to grow and woods has a role in both advancing research and educating the next generation of leaders to succeed in and shape the digital economy. Developing passion for learning. You will never cease to grow and woods has a role in both advancing research and educating the next generation of leaders to succeed in and shape the digital economy. Developing passion for learning. You will never cease to grow and woods has a role in both advancing research and educating the next generation of leaders to succeed in and shape the digital economy.', 'ABOUT WOODS UNIVERSITY', 'pearson hanyinde dolor sit amet consectetur adipisicing elit. Porro, quidem. Provident maxime expedita distinctio ab. Sapiente, nihil assumenda rerum veniam tempora consequuntur deleniti unde alias ducimus. Ratione assumenda minima quos!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro, quidem. Provident maxime expedita distinctio ab. Sapiente, nihil assumenda rerum veniam tempora consequuntur dele', 'From amateur to professional in carear skills', 'Certifications Available', 'Login', 'Staff', 'staff_loginpage.php', 'Student', 'student_loginpage.php', 'APPLY', 'student_registration.php', 'Resources/wall papers/166.5.jpg', 'Resources/wall papers/221.jpg', 'Resources/wall papers/221.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `home_page2`
--

CREATE TABLE `home_page2` (
  `home_page2_id` bigint(20) UNSIGNED NOT NULL,
  `button` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_page2`
--

INSERT INTO `home_page2` (`home_page2_id`, `button`, `button_url`) VALUES
(1, 'Certificate', 'certificateprograms.php'),
(2, 'Diploma', 'diplomaprodgrams.php'),
(3, 'Degree', 'degreeprodgrams.php'),
(4, 'Masters', 'mastersprodgrams.php'),
(5, 'PhD', 'phdprograms.php');

-- --------------------------------------------------------

--
-- Table structure for table `home_page3`
--

CREATE TABLE `home_page3` (
  `home_page3_id` bigint(20) UNSIGNED NOT NULL,
  `button` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_page3`
--

INSERT INTO `home_page3` (`home_page3_id`, `button`, `button_url`, `Picture`) VALUES
(1, 'Classes', '#', 'Resources/wall papers/243.jpg'),
(2, 'Housing', '#', 'Resources/wall papers/156.jpg'),
(3, 'Canteen', '#', 'Resources/wall papers/158.jpg'),
(4, 'LIbrary', '#', 'Resources/wall papers/157.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mood_of_study`
--

CREATE TABLE `mood_of_study` (
  `mood_id` int(11) NOT NULL,
  `mood_name` varchar(255) NOT NULL CHECK (`mood_name` in ('Online','Full-time','Distance','All','Full-time and Distance','Online and Full-time','Online and Distance'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mood_of_study`
--

INSERT INTO `mood_of_study` (`mood_id`, `mood_name`) VALUES
(1, 'Online'),
(2, 'Full-time'),
(3, 'Distance'),
(4, 'All'),
(5, 'Full-time and Distance'),
(6, 'Online and Full-time'),
(7, 'Online and Distance');

-- --------------------------------------------------------

--
-- Table structure for table `programpage`
--

CREATE TABLE `programpage` (
  `programpage_id` bigint(20) UNSIGNED NOT NULL,
  `heading1` varchar(255) DEFAULT NULL,
  `heading2` varchar(255) DEFAULT NULL,
  `heading2_content1` text DEFAULT NULL,
  `heading2_content2` text DEFAULT NULL,
  `heading2_content3` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `bottom_content` text DEFAULT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `button` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `button2` varchar(255) DEFAULT NULL,
  `button2_url` varchar(255) DEFAULT NULL,
  `background_picture1` varchar(255) DEFAULT NULL,
  `background_picture2` varchar(255) DEFAULT NULL,
  `picture3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programpage`
--

INSERT INTO `programpage` (`programpage_id`, `heading1`, `heading2`, `heading2_content1`, `heading2_content2`, `heading2_content3`, `content`, `bottom_content`, `tittle`, `button`, `button_url`, `button2`, `button2_url`, `background_picture1`, `background_picture2`, `picture3`) VALUES
(1, 'Certifications Available', 'Mood of study', 'Full-time', 'Distance', 'Online\r\n', 'Developing passion for learning. You will never cease to grow and woods has a role in both advancing research and educating the next generation of leaders to succeed in and shape the digital economy. Developing passion for learning. You will never cease to grow and woods has a role in both advancing research and educating the next generation of leaders to succeed in and shape the digital economy.', 'pearson hanyinde dolor sit amet consectetur adipisicing elit. Porro, quidem. Provident maxime expedita distinctio ab. Sapiente, nihil assumenda rerum veniam tempora consequuntur deleniti unde alias ducimus. Ratione assumenda minima quos!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro, quidem. Provident maxime expedita distinctio ab. Sapiente, nihil assumenda rerum veniam tempora consequuntur dele', 'View Programs\r\n', 'Programes', 'program_list.php', 'Apply', 'student_registration.php', 'Resources/wall papers/166.5.jpg', 'Resources/wall papers/232.jpg', 'Resources/wall papers/78.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `programpage2`
--

CREATE TABLE `programpage2` (
  `programpage2_id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programpage2`
--

INSERT INTO `programpage2` (`programpage2_id`, `heading`, `content`) VALUES
(1, 'Certificate', '\r\nAfter you submit your application, you’ll also need to send us a copy of your\r\ny'),
(2, 'Diploma', 'We’ll give you a call, shoot you a text or reach out via email if we’re missing any'),
(3, 'Degree', 'Whether you’re a first-year, transfer, or returning student, there is no fee to apply.'),
(4, 'Masters', 'After you submit your application, you’ll also need to send us a copy of your'),
(5, 'PhD', 'We’ll give you a call, shoot you a text or reach out via email if we’re missing an');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `department_id`) VALUES
(1, 'Computer Science', 1),
(2, 'Information Technology', 1),
(3, 'Business Administration', 2),
(4, 'Economics', 2),
(5, 'Accounting', 2),
(6, 'Engineering', 3),
(7, 'Biology', 4),
(8, 'Mathematics', 4),
(9, 'Physics', 4),
(10, 'Chemistry', 4),
(11, 'Environmental Studies', 4),
(12, 'Nursing', 5),
(13, 'Medicine', 5),
(14, 'Veterinary Science', 5),
(15, 'Pharmacy', 5),
(16, 'Public Health', 5),
(17, 'Psychology', 6),
(18, 'Law', 6),
(19, 'Education', 6),
(20, 'Social Sciences', 6),
(21, 'Communications', 6),
(22, 'Linguistics', 6),
(23, 'Arts and Humanities', 7),
(24, 'Music', 7),
(25, 'Visual Arts', 7),
(26, 'Performing Arts', 7),
(27, 'Agriculture', 8),
(28, 'Forestry', 8),
(29, 'Architecture', 9),
(30, 'Urban Planning', 9),
(31, 'Hospitality and Tourism', 10),
(32, 'Sports and Exercise Science', 10);

-- --------------------------------------------------------

--
-- Table structure for table `program_registration`
--

CREATE TABLE `program_registration` (
  `program_registration_id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `certification_id` int(11) DEFAULT NULL,
  `year_id` int(11) DEFAULT NULL,
  `semester_id` int(11) DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program_registration`
--

INSERT INTO `program_registration` (`program_registration_id`, `program_id`, `certification_id`, `year_id`, `semester_id`, `course_code`) VALUES
(1, 1, 3, 1, 1, 'CS101'),
(2, 1, 3, 1, 1, 'CS102'),
(3, 1, 3, 1, 1, 'CS103'),
(4, 1, 3, 1, 1, 'CS104'),
(5, 1, 3, 1, 2, 'CS105'),
(6, 1, 3, 1, 2, 'CS106'),
(7, 1, 3, 1, 2, 'CS107'),
(8, 1, 3, 1, 2, 'CS108'),
(9, 1, 3, 2, 1, 'CS201'),
(10, 1, 3, 2, 1, 'CS202'),
(11, 1, 3, 2, 1, 'CS203'),
(12, 1, 3, 2, 1, 'CS204'),
(13, 1, 3, 2, 2, 'CS205'),
(14, 1, 3, 2, 2, 'CS206'),
(15, 1, 3, 2, 2, 'CS207'),
(16, 1, 3, 2, 2, 'CS208'),
(17, 1, 3, 3, 1, 'CS301'),
(18, 1, 3, 3, 1, 'CS302'),
(19, 1, 3, 3, 1, 'CS303'),
(20, 1, 3, 3, 1, 'CS304'),
(21, 1, 3, 3, 2, 'CS305'),
(22, 1, 3, 3, 2, 'CS306'),
(23, 1, 3, 3, 2, 'CS307'),
(24, 1, 3, 3, 2, 'CS308'),
(25, 1, 3, 4, 1, 'CS401'),
(26, 1, 3, 4, 1, 'CS402'),
(27, 1, 3, 4, 1, 'CS403'),
(28, 1, 3, 4, 1, 'CS404'),
(29, 1, 3, 4, 2, 'CS405'),
(30, 1, 3, 4, 2, 'CS406'),
(31, 1, 3, 4, 2, 'CS407'),
(32, 1, 3, 4, 2, 'CS408'),
(33, 2, 3, 1, 1, 'IT101'),
(34, 2, 3, 1, 1, 'IT102'),
(35, 2, 3, 1, 1, 'IT103'),
(36, 2, 3, 1, 1, 'IT104'),
(37, 2, 3, 1, 2, 'IT105'),
(38, 2, 3, 1, 2, 'IT106'),
(39, 2, 3, 1, 2, 'IT107'),
(40, 2, 3, 1, 2, 'IT108'),
(41, 2, 3, 2, 1, 'IT201'),
(42, 2, 3, 2, 1, 'IT202'),
(43, 2, 3, 2, 1, 'IT203'),
(44, 2, 3, 2, 1, 'IT204'),
(45, 2, 3, 2, 2, 'IT205'),
(46, 2, 3, 2, 2, 'IT206'),
(47, 2, 3, 2, 2, 'IT207'),
(48, 2, 3, 2, 2, 'IT208'),
(49, 2, 3, 3, 1, 'IT301'),
(50, 2, 3, 3, 1, 'IT302'),
(51, 2, 3, 3, 1, 'IT303'),
(52, 2, 3, 3, 1, 'IT304'),
(53, 2, 3, 3, 2, 'IT305'),
(54, 2, 3, 3, 2, 'IT306'),
(55, 2, 3, 3, 2, 'IT307'),
(56, 2, 3, 3, 2, 'IT308'),
(57, 2, 3, 4, 1, 'IT401'),
(58, 2, 3, 4, 1, 'IT402'),
(59, 2, 3, 4, 1, 'IT403'),
(60, 2, 3, 4, 1, 'IT404'),
(61, 2, 3, 4, 2, 'IT405'),
(62, 2, 3, 4, 2, 'IT406'),
(63, 2, 3, 4, 2, 'IT407'),
(64, 2, 3, 4, 2, 'IT408'),
(65, 3, 3, 1, 1, 'BA101'),
(66, 3, 3, 1, 1, 'BA102'),
(67, 3, 3, 1, 1, 'BA103'),
(68, 3, 3, 1, 1, 'BA104'),
(69, 3, 3, 1, 2, 'BA105'),
(70, 3, 3, 1, 2, 'BA106'),
(71, 3, 3, 1, 2, 'BA107'),
(72, 3, 3, 1, 2, 'BA108'),
(73, 3, 3, 2, 1, 'BA201'),
(74, 3, 3, 2, 1, 'BA202'),
(75, 3, 3, 2, 1, 'BA203'),
(76, 3, 3, 2, 1, 'BA204'),
(77, 3, 3, 2, 2, 'BA205'),
(78, 3, 3, 2, 2, 'BA206'),
(79, 3, 3, 2, 2, 'BA207'),
(80, 3, 3, 2, 2, 'BA208'),
(81, 3, 3, 3, 1, 'BA301'),
(82, 3, 3, 3, 1, 'BA302'),
(83, 3, 3, 3, 1, 'BA303'),
(84, 3, 3, 3, 1, 'BA304'),
(85, 3, 3, 3, 2, 'BA305'),
(86, 3, 3, 3, 2, 'BA306'),
(87, 3, 3, 3, 2, 'BA307'),
(88, 3, 3, 3, 2, 'BA308'),
(89, 3, 3, 4, 1, 'BA401'),
(90, 3, 3, 4, 1, 'BA402'),
(91, 3, 3, 4, 1, 'BA403'),
(92, 3, 3, 4, 1, 'BA404'),
(93, 3, 3, 4, 2, 'BA405'),
(94, 3, 3, 4, 2, 'BA406'),
(95, 3, 3, 4, 2, 'BA407'),
(96, 3, 3, 4, 2, 'BA408'),
(97, 4, 3, 1, 1, 'ECO101'),
(98, 4, 3, 1, 1, 'ECO102'),
(99, 4, 3, 1, 1, 'ECO103'),
(100, 4, 3, 1, 1, 'ECO104'),
(101, 4, 3, 1, 2, 'ECO105'),
(102, 4, 3, 1, 2, 'ECO106'),
(103, 4, 3, 1, 2, 'ECO107'),
(104, 4, 3, 1, 2, 'ECO108'),
(105, 4, 3, 2, 1, 'ECO201'),
(106, 4, 3, 2, 1, 'ECO202'),
(107, 4, 3, 2, 1, 'ECO203'),
(108, 4, 3, 2, 1, 'ECO204'),
(109, 4, 3, 2, 2, 'ECO205'),
(110, 4, 3, 2, 2, 'ECO206'),
(111, 4, 3, 2, 2, 'ECO207'),
(112, 4, 3, 2, 2, 'ECO208'),
(113, 4, 3, 3, 1, 'ECO301'),
(114, 4, 3, 3, 1, 'ECO302'),
(115, 4, 3, 3, 1, 'ECO303'),
(116, 4, 3, 3, 1, 'ECO304'),
(117, 4, 3, 3, 2, 'ECO305'),
(118, 4, 3, 3, 2, 'ECO306'),
(119, 4, 3, 3, 2, 'ECO307'),
(120, 4, 3, 3, 2, 'ECO308'),
(121, 4, 3, 4, 1, 'ECO401'),
(122, 4, 3, 4, 1, 'ECO402'),
(123, 4, 3, 4, 1, 'ECO403'),
(124, 4, 3, 4, 1, 'ECO404'),
(125, 4, 3, 4, 2, 'ECO405'),
(126, 4, 3, 4, 2, 'ECO406'),
(127, 4, 3, 4, 2, 'ECO407'),
(128, 4, 3, 4, 2, 'ECO408'),
(129, 5, 1, 1, 1, 'ACC101'),
(130, 5, 1, 1, 1, 'ACC102'),
(131, 5, 1, 1, 1, 'ACC103'),
(132, 5, 1, 1, 1, 'ACC104'),
(133, 5, 1, 1, 2, 'ACC105'),
(134, 5, 1, 1, 2, 'ACC106'),
(135, 5, 1, 1, 2, 'ACC107'),
(136, 5, 1, 1, 2, 'ACC108'),
(137, 5, 2, 2, 1, 'ACC201'),
(138, 5, 2, 2, 1, 'ACC202'),
(139, 5, 2, 2, 1, 'ACC203'),
(140, 5, 2, 2, 1, 'ACC204'),
(141, 5, 2, 2, 2, 'ACC205'),
(142, 5, 2, 2, 2, 'ACC206'),
(143, 5, 2, 2, 2, 'ACC207'),
(144, 5, 2, 2, 2, 'ACC208'),
(145, 5, 3, 3, 1, 'ACC301'),
(146, 5, 3, 3, 1, 'ACC302'),
(147, 5, 3, 3, 1, 'ACC303'),
(148, 5, 3, 3, 1, 'ACC304'),
(149, 5, 3, 3, 2, 'ACC305'),
(150, 5, 3, 3, 2, 'ACC306'),
(151, 5, 3, 3, 2, 'ACC307'),
(152, 5, 3, 3, 2, 'ACC308'),
(153, 5, 4, 4, 1, 'ACC401'),
(154, 5, 4, 4, 1, 'ACC402'),
(155, 5, 4, 4, 1, 'ACC403'),
(156, 5, 4, 4, 1, 'ACC404'),
(157, 5, 4, 4, 2, 'ACC405'),
(158, 5, 4, 4, 2, 'ACC406'),
(159, 5, 4, 4, 2, 'ACC407'),
(160, 5, 4, 4, 2, 'ACC408'),
(161, 6, 1, 1, 1, 'ENG101'),
(162, 6, 1, 1, 1, 'ENG102'),
(163, 6, 1, 1, 1, 'ENG103'),
(164, 6, 1, 1, 2, 'ENG104'),
(165, 6, 1, 1, 2, 'ENG105'),
(166, 6, 1, 1, 2, 'ENG106'),
(167, 6, 1, 1, 2, 'ENG107'),
(168, 6, 1, 1, 2, 'ENG108'),
(169, 6, 2, 2, 1, 'ENG201'),
(170, 6, 2, 2, 1, 'ENG202'),
(171, 6, 2, 2, 1, 'ENG203'),
(172, 6, 2, 2, 1, 'ENG204'),
(173, 6, 2, 2, 2, 'ENG205'),
(174, 6, 2, 2, 2, 'ENG206'),
(175, 6, 2, 2, 2, 'ENG207'),
(176, 6, 2, 2, 2, 'ENG208'),
(177, 6, 3, 3, 1, 'ENG301'),
(178, 6, 3, 3, 1, 'ENG302'),
(179, 6, 3, 3, 1, 'ENG303'),
(180, 6, 3, 3, 1, 'ENG304'),
(181, 6, 3, 3, 2, 'ENG305'),
(182, 6, 3, 3, 2, 'ENG306'),
(183, 6, 3, 3, 2, 'ENG307'),
(184, 6, 3, 3, 2, 'ENG308'),
(185, 6, 4, 4, 1, 'ENG401'),
(186, 6, 4, 4, 1, 'ENG402'),
(187, 6, 4, 4, 1, 'ENG403'),
(188, 6, 4, 4, 1, 'ENG404'),
(189, 6, 4, 4, 2, 'ENG405'),
(190, 6, 4, 4, 2, 'ENG406'),
(191, 6, 4, 4, 2, 'ENG407'),
(192, 6, 4, 4, 2, 'ENG408'),
(193, 7, 1, 1, 1, 'BIO101'),
(194, 7, 1, 1, 1, 'BIO102'),
(195, 7, 1, 1, 1, 'BIO103'),
(196, 7, 1, 1, 1, 'BIO104'),
(197, 7, 1, 1, 2, 'BIO105'),
(198, 7, 1, 1, 2, 'BIO106'),
(199, 7, 1, 1, 2, 'BIO107'),
(200, 7, 1, 1, 2, 'BIO108'),
(201, 7, 2, 2, 1, 'BIO201'),
(202, 7, 2, 2, 1, 'BIO202'),
(203, 7, 2, 2, 1, 'BIO203'),
(204, 7, 2, 2, 1, 'BIO204'),
(205, 7, 2, 2, 2, 'BIO205'),
(206, 7, 2, 2, 2, 'BIO206'),
(207, 7, 2, 2, 2, 'BIO207'),
(208, 7, 2, 2, 2, 'BIO208'),
(209, 7, 3, 3, 1, 'BIO301'),
(210, 7, 3, 3, 1, 'BIO302'),
(211, 7, 3, 3, 1, 'BIO303'),
(212, 7, 3, 3, 1, 'BIO304'),
(213, 7, 3, 3, 2, 'BIO305'),
(214, 7, 3, 3, 2, 'BIO306'),
(215, 7, 3, 3, 2, 'BIO307'),
(216, 7, 3, 3, 2, 'BIO308'),
(217, 7, 4, 4, 1, 'BIO401'),
(218, 7, 4, 4, 1, 'BIO402'),
(219, 7, 4, 4, 1, 'BIO403'),
(220, 7, 4, 4, 1, 'BIO404'),
(221, 7, 4, 4, 2, 'BIO405'),
(222, 7, 4, 4, 2, 'BIO406'),
(223, 7, 4, 4, 2, 'BIO407'),
(224, 7, 4, 4, 2, 'BIO408'),
(225, 8, 3, 1, 1, 'MATH101'),
(226, 8, 3, 1, 1, 'MATH102'),
(227, 8, 3, 1, 1, 'MATH103'),
(228, 8, 3, 1, 2, 'MATH104'),
(229, 8, 3, 1, 2, 'MATH105'),
(230, 8, 3, 1, 2, 'MATH106'),
(231, 8, 3, 1, 2, 'MATH107'),
(232, 8, 3, 1, 2, 'MATH108'),
(233, 8, 3, 2, 1, 'MATH201'),
(234, 8, 3, 2, 1, 'MATH202'),
(235, 8, 3, 2, 1, 'MATH203'),
(236, 8, 3, 2, 1, 'MATH204'),
(237, 8, 3, 2, 2, 'MATH205'),
(238, 8, 3, 2, 2, 'MATH206'),
(239, 8, 3, 2, 2, 'MATH207'),
(240, 8, 3, 2, 2, 'MATH208'),
(241, 8, 3, 3, 1, 'MATH301'),
(242, 8, 3, 3, 1, 'MATH302'),
(243, 8, 3, 3, 1, 'MATH303'),
(244, 8, 3, 3, 1, 'MATH304'),
(245, 8, 3, 3, 1, 'MATH305'),
(246, 8, 3, 3, 2, 'MATH306'),
(247, 8, 3, 3, 2, 'MATH307'),
(248, 8, 3, 3, 2, 'MATH308'),
(249, 8, 3, 4, 1, 'MATH401'),
(250, 8, 3, 4, 1, 'MATH402'),
(251, 8, 3, 4, 1, 'MATH403'),
(252, 8, 3, 4, 1, 'MATH404'),
(253, 8, 3, 4, 2, 'MATH405'),
(254, 8, 3, 4, 2, 'MATH406'),
(255, 8, 3, 4, 2, 'MATH407'),
(256, 8, 3, 4, 2, 'MATH408'),
(257, 9, 3, 1, 1, 'PHY101'),
(258, 9, 3, 1, 1, 'PHY102'),
(259, 9, 3, 1, 1, 'PHY103'),
(260, 9, 3, 1, 1, 'PHY104'),
(261, 9, 3, 1, 2, 'PHY105'),
(262, 9, 3, 1, 2, 'PHY106'),
(263, 9, 3, 1, 2, 'PHY107'),
(264, 9, 3, 1, 2, 'PHY108'),
(265, 9, 3, 2, 1, 'PHY201'),
(266, 9, 3, 2, 1, 'PHY202'),
(267, 9, 3, 2, 1, 'PHY203'),
(268, 9, 3, 2, 1, 'PHY204'),
(269, 9, 3, 2, 2, 'PHY205'),
(270, 9, 3, 2, 2, 'PHY206'),
(271, 9, 3, 2, 2, 'PHY207'),
(272, 9, 3, 2, 2, 'PHY208'),
(273, 9, 3, 3, 1, 'PHY301'),
(274, 9, 3, 3, 1, 'PHY302'),
(275, 9, 3, 3, 1, 'PHY303'),
(276, 9, 3, 3, 1, 'PHY304'),
(277, 9, 3, 3, 2, 'PHY305'),
(278, 9, 3, 3, 2, 'PHY306'),
(279, 9, 3, 3, 2, 'PHY307'),
(280, 9, 3, 3, 2, 'PHY308'),
(281, 9, 3, 4, 1, 'PHY401'),
(282, 9, 3, 4, 1, 'PHY402'),
(283, 9, 3, 4, 1, 'PHY403'),
(284, 9, 3, 4, 1, 'PHY404'),
(285, 9, 3, 4, 2, 'PHY405'),
(286, 9, 3, 4, 2, 'PHY406'),
(287, 9, 3, 4, 2, 'PHY407'),
(288, 9, 3, 4, 2, 'PHY408'),
(289, 10, 3, 1, 1, 'CHE101'),
(290, 10, 3, 1, 1, 'CHE102'),
(291, 10, 3, 1, 1, 'CHE103'),
(292, 10, 3, 1, 1, 'CHE104'),
(293, 10, 3, 1, 2, 'CHE105'),
(294, 10, 3, 1, 2, 'CHE106'),
(295, 10, 3, 1, 2, 'CHE107'),
(296, 10, 3, 1, 2, 'CHE108'),
(297, 10, 3, 2, 1, 'CHE201'),
(298, 10, 3, 2, 1, 'CHE202'),
(299, 10, 3, 2, 1, 'CHE203'),
(300, 10, 3, 2, 1, 'CHE204'),
(301, 10, 3, 2, 2, 'CHE205'),
(302, 10, 3, 2, 2, 'CHE206'),
(303, 10, 3, 2, 2, 'CHE207'),
(304, 10, 3, 2, 2, 'CHE208'),
(305, 10, 3, 3, 1, 'CHE301'),
(306, 10, 3, 3, 1, 'CHE302'),
(307, 10, 3, 3, 1, 'CHE303'),
(308, 10, 3, 3, 1, 'CHE304'),
(309, 10, 3, 3, 2, 'CHE305'),
(310, 10, 3, 3, 2, 'CHE306'),
(311, 10, 3, 3, 2, 'CHE307'),
(312, 10, 3, 3, 2, 'CHE308'),
(313, 10, 3, 4, 1, 'CHE401'),
(314, 10, 3, 4, 1, 'CHE402'),
(315, 10, 3, 4, 1, 'CHE403'),
(316, 10, 3, 4, 1, 'CHE404'),
(317, 10, 3, 4, 2, 'CHE405'),
(318, 10, 3, 4, 2, 'CHE406'),
(319, 10, 3, 4, 2, 'CHE407'),
(320, 10, 3, 4, 2, 'CHE408'),
(321, 11, 3, 1, 1, 'ENV101'),
(322, 11, 3, 1, 1, 'ENV102'),
(323, 11, 3, 1, 1, 'ENV103'),
(324, 11, 3, 1, 1, 'ENV104'),
(325, 11, 3, 1, 2, 'ENV105'),
(326, 11, 3, 1, 2, 'ENV106'),
(327, 11, 3, 1, 2, 'ENV107'),
(328, 11, 3, 1, 2, 'ENV108'),
(329, 11, 3, 2, 1, 'ENV201'),
(330, 11, 3, 2, 1, 'ENV202'),
(331, 11, 3, 2, 1, 'ENV203'),
(332, 11, 3, 2, 1, 'ENV204'),
(333, 11, 3, 2, 2, 'ENV205'),
(334, 11, 3, 2, 2, 'ENV206'),
(335, 11, 3, 2, 2, 'ENV207'),
(336, 11, 3, 2, 2, 'ENV208'),
(337, 11, 3, 3, 1, 'ENV301'),
(338, 11, 3, 3, 1, 'ENV302'),
(339, 11, 3, 3, 1, 'ENV303'),
(340, 11, 3, 3, 1, 'ENV304'),
(341, 11, 3, 3, 2, 'ENV305'),
(342, 11, 3, 3, 2, 'ENV306'),
(343, 11, 3, 3, 2, 'ENV307'),
(344, 11, 3, 3, 2, 'ENV308'),
(345, 11, 3, 4, 1, 'ENV401'),
(346, 11, 3, 4, 1, 'ENV402'),
(347, 11, 3, 4, 1, 'ENV403'),
(348, 11, 3, 4, 1, 'ENV404'),
(349, 11, 3, 4, 2, 'ENV405'),
(350, 11, 3, 4, 2, 'ENV406'),
(351, 11, 3, 4, 2, 'ENV407'),
(352, 11, 3, 4, 2, 'ENV408'),
(353, 12, 1, 1, 1, 'NUR101'),
(354, 12, 1, 1, 1, 'NUR102'),
(355, 12, 1, 1, 1, 'NUR103'),
(356, 12, 1, 1, 2, 'NUR104'),
(357, 12, 1, 1, 2, 'NUR105'),
(358, 12, 1, 1, 2, 'NUR106'),
(359, 12, 1, 1, 2, 'NUR107'),
(360, 12, 1, 1, 2, 'NUR108'),
(361, 12, 1, 2, 1, 'NUR201'),
(362, 12, 1, 2, 1, 'NUR202'),
(363, 12, 1, 2, 1, 'NUR203'),
(364, 12, 1, 2, 1, 'NUR204'),
(365, 12, 1, 2, 2, 'NUR205'),
(366, 12, 1, 2, 2, 'NUR206'),
(367, 12, 1, 2, 2, 'NUR207'),
(368, 12, 1, 2, 2, 'NUR208'),
(369, 12, 1, 3, 1, 'NUR301'),
(370, 12, 1, 3, 1, 'NUR302'),
(371, 12, 1, 3, 1, 'NUR303'),
(372, 12, 1, 3, 1, 'NUR304'),
(373, 12, 1, 3, 2, 'NUR305'),
(374, 12, 1, 3, 2, 'NUR306'),
(375, 12, 1, 3, 2, 'NUR307'),
(376, 12, 1, 3, 2, 'NUR308'),
(377, 12, 1, 4, 1, 'NUR401'),
(378, 12, 1, 4, 1, 'NUR402'),
(379, 12, 1, 4, 1, 'NUR403'),
(380, 12, 1, 4, 1, 'NUR404'),
(381, 12, 1, 4, 2, 'NUR405'),
(382, 12, 1, 4, 2, 'NUR406'),
(383, 12, 1, 4, 2, 'NUR407'),
(384, 12, 1, 4, 2, 'NUR408'),
(385, 15, 1, 1, 1, 'PHA101'),
(386, 15, 1, 1, 1, 'PHA102'),
(387, 15, 1, 1, 1, 'PHA103'),
(388, 15, 1, 1, 1, 'PHA104'),
(389, 15, 1, 1, 2, 'PHA105'),
(390, 15, 1, 1, 2, 'PHA106'),
(391, 15, 1, 1, 2, 'PHA107'),
(392, 15, 1, 1, 2, 'PHA108'),
(393, 15, 1, 2, 1, 'PHA201'),
(394, 15, 1, 2, 1, 'PHA202'),
(395, 15, 1, 2, 1, 'PHA203'),
(396, 15, 1, 2, 1, 'PHA204'),
(397, 15, 1, 2, 2, 'PHA205'),
(398, 15, 1, 2, 2, 'PHA206'),
(399, 15, 1, 2, 2, 'PHA207'),
(400, 15, 1, 2, 2, 'PHA208'),
(401, 15, 1, 3, 1, 'PHA301'),
(402, 15, 1, 3, 1, 'PHA302'),
(403, 15, 1, 3, 1, 'PHA303'),
(404, 15, 1, 3, 1, 'PHA304'),
(405, 15, 1, 3, 2, 'PHA305'),
(406, 15, 1, 3, 2, 'PHA306'),
(407, 15, 1, 3, 2, 'PHA307'),
(408, 15, 1, 3, 2, 'PHA308'),
(409, 15, 1, 4, 1, 'PHA401'),
(410, 15, 1, 4, 1, 'PHA402'),
(411, 15, 1, 4, 1, 'PHA403'),
(412, 15, 1, 4, 1, 'PHA404'),
(413, 15, 1, 4, 2, 'PHA405'),
(414, 15, 1, 4, 2, 'PHA406'),
(415, 15, 1, 4, 2, 'PHA407'),
(416, 15, 1, 4, 2, 'PHA408'),
(417, 16, 1, 1, 1, 'PUB101'),
(418, 16, 1, 1, 1, 'PUB102'),
(419, 16, 1, 1, 1, 'PUB103'),
(420, 16, 1, 1, 1, 'PUB104'),
(421, 16, 1, 1, 2, 'PUB105'),
(422, 16, 1, 1, 2, 'PUB106'),
(423, 16, 1, 1, 2, 'PUB107'),
(424, 16, 1, 1, 2, 'PUB108'),
(425, 16, 1, 2, 1, 'PUB201'),
(426, 16, 1, 2, 1, 'PUB202'),
(427, 16, 1, 2, 1, 'PUB203'),
(428, 16, 1, 2, 1, 'PUB204'),
(429, 16, 1, 2, 2, 'PUB205'),
(430, 16, 1, 2, 2, 'PUB206'),
(431, 16, 1, 2, 2, 'PUB207'),
(432, 16, 1, 2, 2, 'PUB208'),
(433, 16, 1, 3, 1, 'PUB301'),
(434, 16, 1, 3, 1, 'PUB302'),
(435, 16, 1, 3, 1, 'PUB303'),
(436, 16, 1, 3, 1, 'PUB304'),
(437, 16, 1, 3, 2, 'PUB305'),
(438, 16, 1, 3, 2, 'PUB306'),
(439, 16, 1, 3, 2, 'PUB307'),
(440, 16, 1, 3, 2, 'PUB308'),
(441, 16, 1, 4, 1, 'PUB401'),
(442, 16, 1, 4, 1, 'PUB402'),
(443, 16, 1, 4, 1, 'PUB403'),
(444, 16, 1, 4, 1, 'PUB404'),
(445, 16, 1, 4, 2, 'PUB405'),
(446, 16, 1, 4, 2, 'PUB406'),
(447, 16, 1, 4, 2, 'PUB407'),
(448, 16, 1, 4, 2, 'PUB408'),
(449, 18, 1, 1, 1, 'LAW101'),
(450, 18, 1, 1, 1, 'LAW102'),
(451, 18, 1, 1, 1, 'LAW103'),
(452, 18, 1, 1, 1, 'LAW104'),
(453, 18, 1, 1, 2, 'LAW105'),
(454, 18, 1, 1, 2, 'LAW106'),
(455, 18, 1, 1, 2, 'LAW107'),
(456, 18, 1, 1, 2, 'LAW108'),
(457, 18, 1, 2, 1, 'LAW201'),
(458, 18, 1, 2, 1, 'LAW202'),
(459, 18, 1, 2, 1, 'LAW203'),
(460, 18, 1, 2, 1, 'LAW204'),
(461, 18, 1, 2, 2, 'LAW205'),
(462, 18, 1, 2, 2, 'LAW206'),
(463, 18, 1, 2, 2, 'LAW207'),
(464, 18, 1, 2, 2, 'LAW208'),
(465, 18, 1, 3, 1, 'LAW301'),
(466, 18, 1, 3, 1, 'LAW302'),
(467, 18, 1, 3, 1, 'LAW303'),
(468, 18, 1, 3, 1, 'LAW304'),
(469, 18, 1, 3, 2, 'LAW305'),
(470, 18, 1, 3, 2, 'LAW306'),
(471, 18, 1, 3, 2, 'LAW307'),
(472, 18, 1, 3, 2, 'LAW308'),
(473, 18, 1, 4, 1, 'LAW401'),
(474, 18, 1, 4, 1, 'LAW402'),
(475, 18, 1, 4, 1, 'LAW403'),
(476, 18, 1, 4, 1, 'LAW404'),
(477, 18, 1, 4, 2, 'LAW405'),
(478, 18, 1, 4, 2, 'LAW406'),
(479, 18, 1, 4, 2, 'LAW407'),
(480, 18, 1, 4, 2, 'LAW408'),
(481, 29, 1, 1, 1, 'ARC101'),
(482, 29, 1, 1, 1, 'ARC102'),
(483, 29, 1, 1, 1, 'ARC103'),
(484, 29, 1, 1, 1, 'ARC104'),
(485, 29, 1, 2, 2, 'ARC105'),
(486, 29, 1, 2, 2, 'ARC106'),
(487, 29, 1, 2, 2, 'ARC107'),
(488, 29, 1, 2, 2, 'ARC108'),
(489, 29, 1, 2, 1, 'ARC201'),
(490, 29, 1, 2, 1, 'ARC202'),
(491, 29, 1, 2, 1, 'ARC203'),
(492, 29, 1, 2, 1, 'ARC204'),
(493, 29, 1, 2, 2, 'ARC205'),
(494, 29, 1, 2, 2, 'ARC206'),
(495, 29, 1, 2, 2, 'ARC207'),
(496, 29, 1, 2, 2, 'ARC208'),
(497, 29, 1, 3, 1, 'ARC301'),
(498, 29, 1, 3, 1, 'ARC302'),
(499, 29, 1, 3, 1, 'ARC303'),
(500, 29, 1, 3, 1, 'ARC304'),
(501, 29, 1, 3, 2, 'ARC305'),
(502, 29, 1, 3, 2, 'ARC306'),
(503, 29, 1, 3, 2, 'ARC307'),
(504, 29, 1, 3, 2, 'ARC308'),
(505, 29, 1, 4, 1, 'ARC401'),
(506, 29, 1, 4, 1, 'ARC402'),
(507, 29, 1, 4, 1, 'ARC403'),
(508, 29, 1, 4, 1, 'ARC404'),
(509, 29, 1, 4, 2, 'ARC405'),
(510, 29, 1, 4, 2, 'ARC406'),
(511, 29, 1, 4, 2, 'ARC407'),
(512, 29, 1, 4, 2, 'ARC408'),
(513, 30, 1, 1, 1, 'URP101'),
(514, 30, 1, 1, 1, 'URP102'),
(515, 30, 1, 1, 1, 'URP103'),
(516, 30, 1, 1, 1, 'URP104'),
(517, 30, 1, 2, 2, 'URP105'),
(518, 30, 1, 2, 2, 'URP106'),
(519, 30, 1, 2, 2, 'URP107'),
(520, 30, 1, 2, 2, 'URP108'),
(521, 30, 1, 2, 1, 'URP201'),
(522, 30, 1, 2, 1, 'URP202'),
(523, 30, 1, 2, 1, 'URP203'),
(524, 30, 1, 2, 1, 'URP204'),
(525, 30, 1, 2, 2, 'URP205'),
(526, 30, 1, 2, 2, 'URP206'),
(527, 30, 1, 2, 2, 'URP207'),
(528, 30, 1, 2, 2, 'URP208'),
(529, 30, 1, 3, 1, 'URP301'),
(530, 30, 1, 3, 1, 'URP302'),
(531, 30, 1, 3, 1, 'URP303'),
(532, 30, 1, 3, 1, 'URP304'),
(533, 30, 1, 3, 2, 'URP305'),
(534, 30, 1, 3, 2, 'URP306'),
(535, 30, 1, 3, 2, 'URP307'),
(536, 30, 1, 3, 2, 'URP308'),
(537, 30, 1, 4, 1, 'URP401'),
(538, 30, 1, 4, 1, 'URP402'),
(539, 30, 1, 4, 1, 'URP403'),
(540, 30, 1, 4, 1, 'URP404'),
(541, 30, 1, 4, 2, 'URP405'),
(542, 30, 1, 4, 2, 'URP406'),
(543, 30, 1, 4, 2, 'URP407'),
(544, 30, 1, 4, 2, 'URP408'),
(545, 31, 1, 1, 1, 'HTM101'),
(546, 31, 1, 1, 1, 'HTM102'),
(547, 31, 1, 1, 1, 'HTM103'),
(548, 31, 1, 1, 1, 'HTM104'),
(549, 31, 1, 2, 2, 'HTM105'),
(550, 31, 1, 2, 2, 'HTM106'),
(551, 31, 1, 2, 2, 'HTM107'),
(552, 31, 1, 2, 2, 'HTM108'),
(553, 31, 1, 2, 1, 'HTM201'),
(554, 31, 1, 2, 1, 'HTM202'),
(555, 31, 1, 2, 1, 'HTM203'),
(556, 31, 1, 2, 1, 'HTM204'),
(557, 31, 1, 2, 2, 'HTM205'),
(558, 31, 1, 2, 2, 'HTM206'),
(559, 31, 1, 2, 2, 'HTM207'),
(560, 31, 1, 2, 2, 'HTM208'),
(561, 31, 1, 3, 1, 'HTM301'),
(562, 31, 1, 3, 1, 'HTM302'),
(563, 31, 1, 3, 1, 'HTM303'),
(564, 31, 1, 3, 1, 'HTM304'),
(565, 31, 1, 3, 2, 'HTM305'),
(566, 31, 1, 3, 2, 'HTM306'),
(567, 31, 1, 3, 2, 'HTM307'),
(568, 31, 1, 3, 2, 'HTM308'),
(569, 31, 1, 4, 1, 'HTM401'),
(570, 31, 1, 4, 1, 'HTM402'),
(571, 31, 1, 4, 1, 'HTM403'),
(572, 31, 1, 4, 1, 'HTM404'),
(573, 31, 1, 4, 2, 'HTM405'),
(574, 31, 1, 4, 2, 'HTM406'),
(575, 31, 1, 4, 2, 'HTM407'),
(576, 31, 1, 4, 2, 'HTM408'),
(577, 32, 1, 1, 1, 'SPS101'),
(578, 32, 1, 1, 1, 'SPS102'),
(579, 32, 1, 1, 1, 'SPS103'),
(580, 32, 1, 1, 1, 'SPS104'),
(581, 32, 1, 2, 2, 'SPS105'),
(582, 32, 1, 2, 2, 'SPS106'),
(583, 32, 1, 2, 2, 'SPS107'),
(584, 32, 1, 2, 2, 'SPS108'),
(585, 32, 1, 2, 1, 'SPS201'),
(586, 32, 1, 2, 1, 'SPS202'),
(587, 32, 1, 2, 1, 'SPS203'),
(588, 32, 1, 2, 1, 'SPS204'),
(589, 32, 1, 2, 2, 'SPS205'),
(590, 32, 1, 2, 2, 'SPS206'),
(591, 32, 1, 2, 2, 'SPS207'),
(592, 32, 1, 2, 2, 'SPS208'),
(593, 32, 1, 3, 1, 'SPS301'),
(594, 32, 1, 3, 1, 'SPS302'),
(595, 32, 1, 3, 1, 'SPS303'),
(596, 32, 1, 3, 1, 'SPS304'),
(597, 32, 1, 3, 2, 'SPS305'),
(598, 32, 1, 3, 2, 'SPS306'),
(599, 32, 1, 3, 2, 'SPS307'),
(600, 32, 1, 3, 2, 'SPS308'),
(601, 32, 1, 4, 1, 'SPS401'),
(602, 32, 1, 4, 1, 'SPS402'),
(603, 32, 1, 4, 1, 'SPS403'),
(604, 32, 1, 4, 1, 'SPS404'),
(605, 32, 1, 4, 2, 'SPS405'),
(606, 32, 1, 4, 2, 'SPS406'),
(607, 32, 1, 4, 2, 'SPS407'),
(608, 32, 1, 4, 2, 'SPS408'),
(609, 25, 1, 1, 1, 'VART101'),
(610, 25, 1, 1, 1, 'VART102'),
(611, 25, 1, 1, 1, 'VART103'),
(612, 25, 1, 1, 1, 'VART104'),
(613, 25, 1, 2, 1, 'VART105'),
(614, 25, 1, 2, 1, 'VART106'),
(615, 25, 1, 2, 1, 'VART107'),
(616, 25, 1, 2, 1, 'VART108'),
(617, 25, 1, 2, 1, 'VART201'),
(618, 25, 1, 2, 1, 'VART202'),
(619, 25, 1, 2, 1, 'VART203'),
(620, 25, 1, 2, 1, 'VART204'),
(621, 25, 1, 2, 2, 'VART205'),
(622, 25, 1, 2, 2, 'VART206'),
(623, 25, 1, 2, 2, 'VART207'),
(624, 25, 1, 2, 2, 'VART208'),
(625, 25, 1, 3, 1, 'VART301'),
(626, 25, 1, 3, 1, 'VART302'),
(627, 25, 1, 3, 1, 'VART303'),
(628, 25, 1, 3, 1, 'VART304'),
(629, 25, 1, 3, 2, 'VART305'),
(630, 25, 1, 3, 2, 'VART306'),
(631, 25, 1, 3, 2, 'VART307'),
(632, 25, 1, 3, 2, 'VART308'),
(633, 25, 1, 4, 1, 'VART401'),
(634, 25, 1, 4, 1, 'VART402'),
(635, 25, 1, 4, 1, 'VART403'),
(636, 25, 1, 4, 1, 'VART404'),
(637, 25, 1, 4, 2, 'VART405'),
(638, 25, 1, 4, 2, 'VART406'),
(639, 25, 1, 4, 2, 'VART407'),
(640, 25, 1, 4, 2, 'VART408'),
(641, 26, 1, 1, 1, 'PFA101'),
(642, 26, 1, 1, 1, 'PFA102'),
(643, 26, 1, 1, 1, 'PFA103'),
(644, 26, 1, 1, 1, 'PFA104'),
(645, 26, 1, 2, 1, 'PFA105'),
(646, 26, 1, 2, 1, 'PFA106'),
(647, 26, 1, 2, 1, 'PFA107'),
(648, 26, 1, 2, 1, 'PFA108'),
(649, 26, 1, 2, 1, 'PFA201'),
(650, 26, 1, 2, 1, 'PFA202'),
(651, 26, 1, 2, 1, 'PFA203'),
(652, 26, 1, 2, 1, 'PFA204'),
(653, 26, 1, 2, 2, 'PFA205'),
(654, 26, 1, 2, 2, 'PFA206'),
(655, 26, 1, 2, 2, 'PFA207'),
(656, 26, 1, 2, 2, 'PFA208'),
(657, 26, 1, 3, 1, 'PFA301'),
(658, 26, 1, 3, 1, 'PFA302'),
(659, 26, 1, 3, 1, 'PFA303'),
(660, 26, 1, 3, 1, 'PFA304'),
(661, 26, 1, 3, 2, 'PFA305'),
(662, 26, 1, 3, 2, 'PFA306'),
(663, 26, 1, 3, 2, 'PFA307'),
(664, 26, 1, 3, 2, 'PFA308'),
(665, 26, 1, 4, 1, 'PFA401'),
(666, 26, 1, 4, 1, 'PFA402'),
(667, 26, 1, 4, 1, 'PFA403'),
(668, 26, 1, 4, 1, 'PFA404'),
(669, 26, 1, 4, 2, 'PFA405'),
(670, 26, 1, 4, 2, 'PFA406'),
(671, 26, 1, 4, 2, 'PFA407'),
(672, 26, 1, 4, 2, 'PFA408'),
(673, 27, 1, 1, 1, 'AGR101'),
(674, 27, 1, 1, 1, 'AGR102'),
(675, 27, 1, 1, 1, 'AGR103'),
(676, 27, 1, 1, 1, 'AGR104'),
(677, 27, 1, 2, 1, 'AGR105'),
(678, 27, 1, 2, 1, 'AGR106'),
(679, 27, 1, 2, 1, 'AGR107'),
(680, 27, 1, 2, 1, 'AGR108'),
(681, 27, 1, 2, 1, 'AGR201'),
(682, 27, 1, 2, 1, 'AGR202'),
(683, 27, 1, 2, 1, 'AGR203'),
(684, 27, 1, 2, 1, 'AGR204'),
(685, 27, 1, 2, 2, 'AGR205'),
(686, 27, 1, 2, 2, 'AGR206'),
(687, 27, 1, 2, 2, 'AGR207'),
(688, 27, 1, 2, 2, 'AGR208'),
(689, 27, 1, 3, 1, 'AGR301'),
(690, 27, 1, 3, 1, 'AGR302'),
(691, 27, 1, 3, 1, 'AGR303'),
(692, 27, 1, 3, 1, 'AGR304'),
(693, 27, 1, 3, 2, 'AGR305'),
(694, 27, 1, 3, 2, 'AGR306'),
(695, 27, 1, 3, 2, 'AGR307'),
(696, 27, 1, 3, 2, 'AGR308'),
(697, 27, 1, 4, 1, 'AGR401'),
(698, 27, 1, 4, 1, 'AGR402'),
(699, 27, 1, 4, 1, 'AGR403'),
(700, 27, 1, 4, 1, 'AGR404'),
(701, 27, 1, 4, 2, 'AGR405'),
(702, 27, 1, 4, 2, 'AGR406'),
(703, 27, 1, 4, 2, 'AGR407'),
(704, 27, 1, 4, 2, 'AGR408'),
(705, 28, 1, 1, 1, 'FOR101'),
(706, 28, 1, 1, 1, 'FOR102'),
(707, 28, 1, 1, 1, 'FOR103'),
(708, 28, 1, 1, 1, 'FOR104'),
(709, 28, 1, 2, 1, 'FOR105'),
(710, 28, 1, 2, 1, 'FOR106'),
(711, 28, 1, 2, 1, 'FOR107'),
(712, 28, 1, 2, 1, 'FOR108'),
(713, 28, 1, 2, 1, 'FOR201'),
(714, 28, 1, 2, 1, 'FOR202'),
(715, 28, 1, 2, 1, 'FOR203'),
(716, 28, 1, 2, 1, 'FOR204'),
(717, 28, 1, 2, 2, 'FOR205'),
(718, 28, 1, 2, 2, 'FOR206'),
(719, 28, 1, 2, 2, 'FOR207'),
(720, 28, 1, 2, 2, 'FOR208'),
(721, 28, 1, 3, 1, 'FOR301'),
(722, 28, 1, 3, 1, 'FOR302'),
(723, 28, 1, 3, 1, 'FOR303'),
(724, 28, 1, 3, 1, 'FOR304'),
(725, 28, 1, 3, 2, 'FOR305'),
(726, 28, 1, 3, 2, 'FOR306'),
(727, 28, 1, 3, 2, 'FOR307'),
(728, 28, 1, 3, 2, 'FOR308'),
(729, 28, 1, 4, 1, 'FOR401'),
(730, 28, 1, 4, 1, 'FOR402'),
(731, 28, 1, 4, 1, 'FOR403'),
(732, 28, 1, 4, 1, 'FOR404'),
(733, 28, 1, 4, 2, 'FOR405'),
(734, 28, 1, 4, 2, 'FOR406'),
(735, 28, 1, 4, 2, 'FOR407'),
(736, 28, 1, 4, 2, 'FOR408'),
(737, 21, 3, 1, 1, 'COM101'),
(738, 21, 3, 1, 1, 'COM102'),
(739, 21, 3, 1, 1, 'COM103'),
(740, 21, 3, 1, 1, 'COM104'),
(741, 21, 3, 1, 2, 'COM105'),
(742, 21, 3, 1, 2, 'COM106'),
(743, 21, 3, 1, 2, 'COM107'),
(744, 21, 3, 1, 2, 'COM108'),
(745, 21, 3, 2, 1, 'COM201'),
(746, 21, 3, 2, 1, 'COM202'),
(747, 21, 3, 2, 1, 'COM203'),
(748, 21, 3, 2, 1, 'COM204'),
(749, 21, 3, 2, 2, 'COM205'),
(750, 21, 3, 2, 2, 'COM206'),
(751, 21, 3, 2, 2, 'COM207'),
(752, 21, 3, 2, 2, 'COM208'),
(753, 21, 3, 3, 1, 'COM301'),
(754, 21, 3, 3, 1, 'COM302'),
(755, 21, 3, 3, 1, 'COM303'),
(756, 21, 3, 3, 1, 'COM304'),
(757, 21, 3, 3, 2, 'COM305'),
(758, 21, 3, 3, 2, 'COM306'),
(759, 21, 3, 3, 2, 'COM307'),
(760, 21, 3, 3, 2, 'COM308'),
(761, 21, 3, 4, 1, 'COM401'),
(762, 21, 3, 4, 1, 'COM402'),
(763, 21, 3, 4, 1, 'COM403'),
(764, 21, 3, 4, 1, 'COM404'),
(765, 21, 3, 4, 2, 'COM405'),
(766, 21, 3, 4, 2, 'COM406'),
(767, 21, 3, 4, 2, 'COM407'),
(768, 21, 3, 4, 2, 'COM408'),
(769, 22, 3, 1, 1, 'LIN101'),
(770, 22, 3, 1, 1, 'LIN102'),
(771, 22, 3, 1, 1, 'LIN103'),
(772, 22, 3, 1, 1, 'LIN104'),
(773, 22, 3, 1, 2, 'LIN105'),
(774, 22, 3, 1, 2, 'LIN106'),
(775, 22, 3, 1, 2, 'LIN107'),
(776, 22, 3, 1, 2, 'LIN108'),
(777, 22, 3, 2, 1, 'LIN201'),
(778, 22, 3, 2, 1, 'LIN202'),
(779, 22, 3, 2, 1, 'LIN203'),
(780, 22, 3, 2, 1, 'LIN204'),
(781, 22, 3, 2, 2, 'LIN205'),
(782, 22, 3, 2, 2, 'LIN206'),
(783, 22, 3, 2, 2, 'LIN207'),
(784, 22, 3, 2, 2, 'LIN208'),
(785, 22, 3, 3, 1, 'LIN301'),
(786, 22, 3, 3, 1, 'LIN302'),
(787, 22, 3, 3, 1, 'LIN303'),
(788, 22, 3, 3, 1, 'LIN304'),
(789, 22, 3, 3, 2, 'LIN305'),
(790, 22, 3, 3, 2, 'LIN306'),
(791, 22, 3, 3, 2, 'LIN307'),
(792, 22, 3, 3, 2, 'LIN308'),
(793, 22, 3, 4, 1, 'LIN401'),
(794, 22, 3, 4, 1, 'LIN402'),
(795, 22, 3, 4, 1, 'LIN403'),
(796, 22, 3, 4, 1, 'LIN404'),
(797, 22, 3, 4, 2, 'LIN405'),
(798, 22, 3, 4, 2, 'LIN406'),
(799, 22, 3, 4, 2, 'LIN407'),
(800, 22, 3, 4, 2, 'LIN408'),
(801, 23, 3, 1, 1, 'ART101'),
(802, 23, 3, 1, 1, 'ART102'),
(803, 23, 3, 1, 1, 'ART103'),
(804, 23, 3, 1, 1, 'ART104'),
(805, 23, 3, 1, 2, 'ART105'),
(806, 23, 3, 1, 2, 'ART106'),
(807, 23, 3, 1, 2, 'ART107'),
(808, 23, 3, 1, 2, 'ART108'),
(809, 23, 3, 2, 1, 'ART201'),
(810, 23, 3, 2, 1, 'ART202'),
(811, 23, 3, 2, 1, 'ART203'),
(812, 23, 3, 2, 1, 'ART204'),
(813, 23, 3, 2, 2, 'ART205'),
(814, 23, 3, 2, 2, 'ART206'),
(815, 23, 3, 2, 2, 'ART207'),
(816, 23, 3, 2, 2, 'ART208'),
(817, 23, 3, 3, 1, 'ART301'),
(818, 23, 3, 3, 1, 'ART302'),
(819, 23, 3, 3, 1, 'ART303'),
(820, 23, 3, 3, 1, 'ART304'),
(821, 23, 3, 3, 2, 'ART305'),
(822, 23, 3, 3, 2, 'ART306'),
(823, 23, 3, 3, 2, 'ART307'),
(824, 23, 3, 3, 2, 'ART308'),
(825, 23, 3, 4, 1, 'ART401'),
(826, 23, 3, 4, 1, 'ART402'),
(827, 23, 3, 4, 1, 'ART403'),
(828, 23, 3, 4, 1, 'ART404'),
(829, 23, 3, 4, 2, 'ART405'),
(830, 23, 3, 4, 2, 'ART406'),
(831, 23, 3, 4, 2, 'ART407'),
(832, 23, 3, 4, 2, 'ART408'),
(833, 24, 3, 1, 1, 'MUS101'),
(834, 24, 3, 1, 1, 'MUS102'),
(835, 24, 3, 1, 1, 'MUS103'),
(836, 24, 3, 1, 1, 'MUS104'),
(837, 24, 3, 1, 2, 'MUS105'),
(838, 24, 3, 1, 2, 'MUS106'),
(839, 24, 3, 1, 2, 'MUS107'),
(840, 24, 3, 1, 2, 'MUS108'),
(841, 24, 3, 2, 1, 'MUS201'),
(842, 24, 3, 2, 1, 'MUS202'),
(843, 24, 3, 2, 1, 'MUS203'),
(844, 24, 3, 2, 1, 'MUS204'),
(845, 24, 3, 2, 2, 'MUS205'),
(846, 24, 3, 2, 2, 'MUS206'),
(847, 24, 3, 2, 2, 'MUS207'),
(848, 24, 3, 2, 2, 'MUS208'),
(849, 24, 3, 3, 1, 'MUS301'),
(850, 24, 3, 3, 1, 'MUS302'),
(851, 24, 3, 3, 1, 'MUS303'),
(852, 24, 3, 3, 1, 'MUS304'),
(853, 24, 3, 3, 2, 'MUS305'),
(854, 24, 3, 3, 2, 'MUS306'),
(855, 24, 3, 3, 2, 'MUS307'),
(856, 24, 3, 3, 2, 'MUS308'),
(857, 24, 3, 4, 1, 'MUS401'),
(858, 24, 3, 4, 1, 'MUS402'),
(859, 24, 3, 4, 1, 'MUS403'),
(860, 24, 3, 4, 1, 'MUS404'),
(861, 24, 3, 4, 2, 'MUS405'),
(862, 24, 3, 4, 2, 'MUS406'),
(863, 24, 3, 4, 2, 'MUS407'),
(864, 24, 3, 4, 2, 'MUS408'),
(865, 19, 3, 1, 1, 'EDU101'),
(866, 19, 3, 1, 1, 'EDU102'),
(867, 19, 3, 1, 1, 'EDU103'),
(868, 19, 3, 1, 1, 'EDU104'),
(869, 19, 3, 1, 2, 'EDU105'),
(870, 19, 3, 1, 2, 'EDU106'),
(871, 19, 3, 1, 2, 'EDU107'),
(872, 19, 3, 1, 2, 'EDU108'),
(873, 19, 3, 2, 1, 'EDU201'),
(874, 19, 3, 2, 1, 'EDU202'),
(875, 19, 3, 2, 1, 'EDU203'),
(876, 19, 3, 2, 1, 'EDU204'),
(877, 19, 3, 2, 2, 'EDU205'),
(878, 19, 3, 2, 2, 'EDU206'),
(879, 19, 3, 2, 2, 'EDU207'),
(880, 19, 3, 2, 2, 'EDU208'),
(881, 19, 3, 3, 1, 'EDU301'),
(882, 19, 3, 3, 1, 'EDU302'),
(883, 19, 3, 3, 1, 'EDU303'),
(884, 19, 3, 3, 1, 'EDU304'),
(885, 19, 3, 3, 2, 'EDU305'),
(886, 19, 3, 3, 2, 'EDU306'),
(887, 19, 3, 3, 2, 'EDU307'),
(888, 19, 3, 3, 2, 'EDU308'),
(889, 19, 3, 4, 1, 'EDU401'),
(890, 19, 3, 4, 1, 'EDU402'),
(891, 19, 3, 4, 1, 'EDU403'),
(892, 19, 3, 4, 1, 'EDU404'),
(893, 19, 3, 4, 2, 'EDU405'),
(894, 19, 3, 4, 2, 'EDU406'),
(895, 19, 3, 4, 2, 'EDU407'),
(896, 19, 3, 4, 2, 'EDU408'),
(897, 20, 3, 1, 1, 'SOC101'),
(898, 20, 3, 1, 1, 'SOC102'),
(899, 20, 3, 1, 1, 'SOC103'),
(900, 20, 3, 1, 1, 'SOC104'),
(901, 20, 3, 1, 2, 'SOC105'),
(902, 20, 3, 1, 2, 'SOC106'),
(903, 20, 3, 1, 2, 'SOC107'),
(904, 20, 3, 1, 2, 'SOC108'),
(905, 20, 3, 2, 1, 'SOC201'),
(906, 20, 3, 2, 1, 'SOC202'),
(907, 20, 3, 2, 1, 'SOC203'),
(908, 20, 3, 2, 1, 'SOC204'),
(909, 20, 3, 2, 2, 'SOC205'),
(910, 20, 3, 2, 2, 'SOC206'),
(911, 20, 3, 2, 2, 'SOC207'),
(912, 20, 3, 2, 2, 'SOC208'),
(913, 20, 3, 3, 1, 'SOC301'),
(914, 20, 3, 3, 1, 'SOC302'),
(915, 20, 3, 3, 1, 'SOC303'),
(916, 20, 3, 3, 1, 'SOC304'),
(917, 20, 3, 3, 2, 'SOC305'),
(918, 20, 3, 3, 2, 'SOC306'),
(919, 20, 3, 3, 2, 'SOC307'),
(920, 20, 3, 3, 2, 'SOC308'),
(921, 20, 3, 4, 1, 'SOC401'),
(922, 20, 3, 4, 1, 'SOC402'),
(923, 20, 3, 4, 1, 'SOC403'),
(924, 20, 3, 4, 1, 'SOC404'),
(925, 20, 3, 4, 2, 'SOC405'),
(926, 20, 3, 4, 2, 'SOC406'),
(927, 20, 3, 4, 2, 'SOC407'),
(928, 20, 3, 4, 2, 'SOC408');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`) VALUES
(1, 'First semester'),
(2, 'Second semester');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL CHECK (`gender` in ('f','m','o')),
  `phone_number` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `emergency_phone` int(11) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `profile_picture` blob DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `job_tittle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_address`
--

CREATE TABLE `staff_address` (
  `adress_id` int(11) NOT NULL,
  `adress_line1` varchar(255) DEFAULT NULL,
  `adress_line2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_education`
--

CREATE TABLE `staff_education` (
  `education_id` int(11) NOT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `level_of_qualification` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `date_graduated` date DEFAULT NULL,
  `school_adress` varchar(255) DEFAULT NULL,
  `qualification_document` blob DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff_login`
--

CREATE TABLE `staff_login` (
  `login_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL CHECK (`gender` in ('f','m','o')),
  `phone_number` bigint(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `emergency_phone` bigint(11) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `profile_picture` blob DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `middle_name`, `last_name`, `gender`, `phone_number`, `email`, `religion`, `date_of_birth`, `emergency_phone`, `marital_status`, `profile_picture`, `program_id`) VALUES
(192, 'Erick ', '', 'maliko', 'M', 66666, 'erickworkspace6969@gmail.com', 'Shintoism ', '2024-08-18', 977961230, 'Divorced', 0x312e6a7067, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_address`
--

CREATE TABLE `student_address` (
  `adress_id` int(11) NOT NULL,
  `adress_line1` varchar(255) DEFAULT NULL,
  `adress_line2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_address`
--

INSERT INTO `student_address` (`adress_id`, `adress_line1`, `adress_line2`, `city`, `state`, `nationality`, `zipcode`, `student_id`) VALUES
(6, '733 59th St', 'ESCO MONGU TRADES ROAD', 'Brooklyn', 'NY', 'Albania', '11220', 192);

-- --------------------------------------------------------

--
-- Table structure for table `student_education`
--

CREATE TABLE `student_education` (
  `education_id` int(11) NOT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `level_of_qualification` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `date_graduated` date DEFAULT NULL,
  `school_adress` varchar(255) DEFAULT NULL,
  `qualification_document` blob DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_education`
--

INSERT INTO `student_education` (`education_id`, `school_name`, `level_of_qualification`, `entry_date`, `date_graduated`, `school_adress`, `qualification_document`, `student_id`) VALUES
(4, 'Mulamatiwa Basic School', 'hhhh', '2024-08-30', '2024-08-24', 'hhhh', 0x322e6a7067, 192);

-- --------------------------------------------------------

--
-- Table structure for table `student_login`
--

CREATE TABLE `student_login` (
  `login_id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_login`
--

INSERT INTO `student_login` (`login_id`, `user`, `password`, `student_id`) VALUES
(2, 'erickworkspace6969@gmail.com', '$2y$10$1q4Zrz.C8tNw3SsXqLRmWOs6vEMK8p/e5amXwjcnZOUHA0MtBZb2S', 192);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `year_id` int(11) NOT NULL,
  `year_name` varchar(255) NOT NULL CHECK (`year_name` in ('First year','Second year','Third year','Fourth year','Fith year','Sixth year','Seventh year','Eigth year','Nineth year','Tenth year'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`year_id`, `year_name`) VALUES
(1, 'First year'),
(2, 'Second year'),
(3, 'Third year'),
(4, 'Fourth year'),
(5, 'Fith year'),
(6, 'Sixth year'),
(7, 'Seventh year'),
(8, 'Eigth year'),
(9, 'Nineth year'),
(10, 'Tenth year');

-- --------------------------------------------------------

--
-- Table structure for table `years_of_study`
--

CREATE TABLE `years_of_study` (
  `years_of_study_id` int(11) NOT NULL,
  `year_number` int(11) NOT NULL CHECK (`year_number` in (1,2,3,4,5,6,7,8,9,10))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `years_of_study`
--

INSERT INTO `years_of_study` (`years_of_study_id`, `year_number`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accademic_table`
--
ALTER TABLE `accademic_table`
  ADD PRIMARY KEY (`accademic_table_id`);

--
-- Indexes for table `admision`
--
ALTER TABLE `admision`
  ADD PRIMARY KEY (`admision_id`);

--
-- Indexes for table `admision2`
--
ALTER TABLE `admision2`
  ADD PRIMARY KEY (`admision2_id`);

--
-- Indexes for table `admision3`
--
ALTER TABLE `admision3`
  ADD PRIMARY KEY (`admision3_id`);

--
-- Indexes for table `allprograms`
--
ALTER TABLE `allprograms`
  ADD PRIMARY KEY (`allprograms_id`),
  ADD KEY `certification_id` (`certification_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `years_of_study_id` (`years_of_study_id`),
  ADD KEY `mood_id` (`mood_id`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`certification_id`);

--
-- Indexes for table `copyright`
--
ALTER TABLE `copyright`
  ADD PRIMARY KEY (`copyright_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `cumpus_housing`
--
ALTER TABLE `cumpus_housing`
  ADD PRIMARY KEY (`cumpus_housing_id`);

--
-- Indexes for table `cumpus_housing_heading_list`
--
ALTER TABLE `cumpus_housing_heading_list`
  ADD PRIMARY KEY (`heading_list_id`);

--
-- Indexes for table `cumpus_housing_lists`
--
ALTER TABLE `cumpus_housing_lists`
  ADD PRIMARY KEY (`cumpus_housing_lists_id`),
  ADD KEY `heading_list_id` (`heading_list_id`);

--
-- Indexes for table `cumpus_housing_nav_links`
--
ALTER TABLE `cumpus_housing_nav_links`
  ADD PRIMARY KEY (`cumpus_housing_nav_links_id`);

--
-- Indexes for table `cumpus_housing_slides_images`
--
ALTER TABLE `cumpus_housing_slides_images`
  ADD PRIMARY KEY (`cumpus_housing_slides_images_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `fees_and_finicial_aid_2`
--
ALTER TABLE `fees_and_finicial_aid_2`
  ADD PRIMARY KEY (`fees_and_finicial_aid_2_id`);

--
-- Indexes for table `fees_and_finicial_aid_admin`
--
ALTER TABLE `fees_and_finicial_aid_admin`
  ADD PRIMARY KEY (`fees_and_finicial_aid_admin_id`);

--
-- Indexes for table `footer_lists`
--
ALTER TABLE `footer_lists`
  ADD PRIMARY KEY (`footer_lists_id`),
  ADD KEY `list_heading_id` (`list_heading_id`);

--
-- Indexes for table `footer_list_heading`
--
ALTER TABLE `footer_list_heading`
  ADD PRIMARY KEY (`list_heading_id`);

--
-- Indexes for table `home_nav`
--
ALTER TABLE `home_nav`
  ADD PRIMARY KEY (`home_nav_id`);

--
-- Indexes for table `home_page`
--
ALTER TABLE `home_page`
  ADD PRIMARY KEY (`home_page_id`);

--
-- Indexes for table `home_page2`
--
ALTER TABLE `home_page2`
  ADD PRIMARY KEY (`home_page2_id`);

--
-- Indexes for table `home_page3`
--
ALTER TABLE `home_page3`
  ADD PRIMARY KEY (`home_page3_id`);

--
-- Indexes for table `mood_of_study`
--
ALTER TABLE `mood_of_study`
  ADD PRIMARY KEY (`mood_id`);

--
-- Indexes for table `programpage`
--
ALTER TABLE `programpage`
  ADD PRIMARY KEY (`programpage_id`);

--
-- Indexes for table `programpage2`
--
ALTER TABLE `programpage2`
  ADD PRIMARY KEY (`programpage2_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `program_registration`
--
ALTER TABLE `program_registration`
  ADD PRIMARY KEY (`program_registration_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `certification_id` (`certification_id`),
  ADD KEY `year_id` (`year_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `staff_address`
--
ALTER TABLE `staff_address`
  ADD PRIMARY KEY (`adress_id`),
  ADD KEY `lecture_id` (`staff_id`);

--
-- Indexes for table `staff_education`
--
ALTER TABLE `staff_education`
  ADD PRIMARY KEY (`education_id`),
  ADD KEY `lecture_id` (`staff_id`);

--
-- Indexes for table `staff_login`
--
ALTER TABLE `staff_login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `lecture_id` (`staff_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `student_address`
--
ALTER TABLE `student_address`
  ADD PRIMARY KEY (`adress_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_education`
--
ALTER TABLE `student_education`
  ADD PRIMARY KEY (`education_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student_login`
--
ALTER TABLE `student_login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`year_id`);

--
-- Indexes for table `years_of_study`
--
ALTER TABLE `years_of_study`
  ADD PRIMARY KEY (`years_of_study_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accademic_table`
--
ALTER TABLE `accademic_table`
  MODIFY `accademic_table_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admision`
--
ALTER TABLE `admision`
  MODIFY `admision_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admision2`
--
ALTER TABLE `admision2`
  MODIFY `admision2_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admision3`
--
ALTER TABLE `admision3`
  MODIFY `admision3_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `allprograms`
--
ALTER TABLE `allprograms`
  MODIFY `allprograms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `certification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `copyright`
--
ALTER TABLE `copyright`
  MODIFY `copyright_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cumpus_housing`
--
ALTER TABLE `cumpus_housing`
  MODIFY `cumpus_housing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cumpus_housing_heading_list`
--
ALTER TABLE `cumpus_housing_heading_list`
  MODIFY `heading_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cumpus_housing_lists`
--
ALTER TABLE `cumpus_housing_lists`
  MODIFY `cumpus_housing_lists_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cumpus_housing_nav_links`
--
ALTER TABLE `cumpus_housing_nav_links`
  MODIFY `cumpus_housing_nav_links_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cumpus_housing_slides_images`
--
ALTER TABLE `cumpus_housing_slides_images`
  MODIFY `cumpus_housing_slides_images_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `fees_and_finicial_aid_2`
--
ALTER TABLE `fees_and_finicial_aid_2`
  MODIFY `fees_and_finicial_aid_2_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fees_and_finicial_aid_admin`
--
ALTER TABLE `fees_and_finicial_aid_admin`
  MODIFY `fees_and_finicial_aid_admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `footer_lists`
--
ALTER TABLE `footer_lists`
  MODIFY `footer_lists_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `footer_list_heading`
--
ALTER TABLE `footer_list_heading`
  MODIFY `list_heading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_nav`
--
ALTER TABLE `home_nav`
  MODIFY `home_nav_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `home_page`
--
ALTER TABLE `home_page`
  MODIFY `home_page_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_page2`
--
ALTER TABLE `home_page2`
  MODIFY `home_page2_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `home_page3`
--
ALTER TABLE `home_page3`
  MODIFY `home_page3_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mood_of_study`
--
ALTER TABLE `mood_of_study`
  MODIFY `mood_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `programpage`
--
ALTER TABLE `programpage`
  MODIFY `programpage_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programpage2`
--
ALTER TABLE `programpage2`
  MODIFY `programpage2_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `program_registration`
--
ALTER TABLE `program_registration`
  MODIFY `program_registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=929;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_address`
--
ALTER TABLE `staff_address`
  MODIFY `adress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_education`
--
ALTER TABLE `staff_education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff_login`
--
ALTER TABLE `staff_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_address`
--
ALTER TABLE `student_address`
  MODIFY `adress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_education`
--
ALTER TABLE `student_education`
  MODIFY `education_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_login`
--
ALTER TABLE `student_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `years_of_study`
--
ALTER TABLE `years_of_study`
  MODIFY `years_of_study_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allprograms`
--
ALTER TABLE `allprograms`
  ADD CONSTRAINT `allprograms_ibfk_1` FOREIGN KEY (`certification_id`) REFERENCES `certifications` (`certification_id`),
  ADD CONSTRAINT `allprograms_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`),
  ADD CONSTRAINT `allprograms_ibfk_3` FOREIGN KEY (`years_of_study_id`) REFERENCES `years_of_study` (`years_of_study_id`),
  ADD CONSTRAINT `allprograms_ibfk_4` FOREIGN KEY (`mood_id`) REFERENCES `mood_of_study` (`mood_id`);

--
-- Constraints for table `cumpus_housing_lists`
--
ALTER TABLE `cumpus_housing_lists`
  ADD CONSTRAINT `cumpus_housing_lists_ibfk_1` FOREIGN KEY (`heading_list_id`) REFERENCES `cumpus_housing_heading_list` (`heading_list_id`) ON DELETE CASCADE;

--
-- Constraints for table `footer_lists`
--
ALTER TABLE `footer_lists`
  ADD CONSTRAINT `footer_lists_ibfk_1` FOREIGN KEY (`list_heading_id`) REFERENCES `footer_list_heading` (`list_heading_id`);

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `program_registration`
--
ALTER TABLE `program_registration`
  ADD CONSTRAINT `program_registration_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`),
  ADD CONSTRAINT `program_registration_ibfk_2` FOREIGN KEY (`certification_id`) REFERENCES `certifications` (`certification_id`),
  ADD CONSTRAINT `program_registration_ibfk_3` FOREIGN KEY (`year_id`) REFERENCES `year` (`year_id`),
  ADD CONSTRAINT `program_registration_ibfk_4` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `program_registration_ibfk_5` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `staff_address`
--
ALTER TABLE `staff_address`
  ADD CONSTRAINT `staff_address_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `staff_education`
--
ALTER TABLE `staff_education`
  ADD CONSTRAINT `staff_education_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `staff_login`
--
ALTER TABLE `staff_login`
  ADD CONSTRAINT `staff_login_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`);

--
-- Constraints for table `student_address`
--
ALTER TABLE `student_address`
  ADD CONSTRAINT `student_address_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `student_education`
--
ALTER TABLE `student_education`
  ADD CONSTRAINT `student_education_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `student_login`
--
ALTER TABLE `student_login`
  ADD CONSTRAINT `student_login_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
