-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2018 at 09:40 PM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.5-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp_backoffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `psychometricEvaluationQuestions`
--

CREATE TABLE `psychometricEvaluationQuestions` (
  `psychometricEvaluationQuestionID` int(5) NOT NULL,
  `psychometricEvaluationQuestion` text NOT NULL,
  `psychometricE1psychometricEvaluationQuestionOptions` longtext NOT NULL,
  `addedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `psychometricEvaluationQuestions`
--

INSERT INTO `psychometricEvaluationQuestions` (`psychometricEvaluationQuestionID`, `psychometricEvaluationQuestion`, `psychometricE1psychometricEvaluationQuestionOptions`, `addedAt`, `active`) VALUES
(1, '<p>An organisational restructure saw the administration department taking responsibility for payroll, which was previously managed by finance administrators. During this transition period, the finance team still holds most of the key payroll related information, which will be transferred to the administration team over the coming months. The finance department however, operates in another building, making internal communication difficult. They rarely answer phone calls and take an excessively long time to reply to emails. This makes managing payroll very difficult, and you fear that staff may not be paid on time.</p>', '{\"option1\":{\"option\":\"<p>Refuse to manage payroll until the finance team start cooperating with the admin team.<\\/p>\",\"category\":\"3\"},\"option2\":{\"option\":\"<p>Take no additional action and blame the finance team for any payroll related issues.<\\/p>\",\"category\":\"4\"},\"option3\":{\"option\":\"<p>Ensure that the finance team are not paid on time, forcing them to take the matter seriously.<\\/p>\",\"category\":\"2\"},\"option4\":{\"option\":\"<p>Arrange regular conference calls with the finance team, ensuring the exchange of information.<\\/p>\",\"category\":\"1\"}}', '2018-07-02 16:01:40', 1),
(2, '<p>You have recently invoiced a new client for products sold and services rendered, but you feel the client is being evasive. Two weeks after receiving your invoice, the client requested an alternative invoice format, stating their system cannot process the invoice in its current state. You oblige and resend the invoice, but after another week they request that additional account information be presented on the invoice, which is highly unusual. Based on conversations with your manager, it seems the client is experiencing financial problems, and may be unable to pay the invoice at this time.</p>', '{\"option1\":{\"option\":\"<p>Refuse to update the invoice and remind the client of their obligation to pay.<\\/p>\",\"category\":\"3\"},\"option2\":{\"option\":\"<p>Write-off the costs as a loss and refuse to work with the client again.<\\/p>\",\"category\":\"4\"},\"option3\":{\"option\":\"<p>Call the client, discuss an alternative payment plan to better suit their financial situation.<\\/p>\",\"category\":\"2\"},\"option4\":{\"option\":\"<p>Offer to invoice for products and services separately, making each invoice easier to pay.<\\/p>\",\"category\":\"1\"}}', '2018-07-02 16:02:46', 1),
(3, '<p>A client engagement team has booked the main meeting room, inviting a large potential client for an initial meeting. This prospective client represents one of the largest opportunities of the year, and winning their business is considered the top priority for the engagement team. However, due to a technical error with the room booking software, the room is now double booked. The managing director (MD) had previously booked to room, having arranged a meeting with a smaller existing client. Both the new and prospective client are on their way to their respective meetings, and every other meeting room has been booked. How you will respond to this situation?</p>', '{\"option1\":{\"option\":\"<p>Inform the engagement team that the room has already been booked, and they must go elsewhere.<\\/p>\",\"category\":\"4\"},\"option2\":{\"option\":\"<p>Take no action and pretend that you were unaware of the double booking when the delegates arrive.<\\/p>\",\"category\":\"3\"},\"option3\":{\"option\":\"<p>Call the managing director, explain the situation and ask how they would like you to proceed<\\/p>\",\"category\":\"2\"},\"option4\":{\"option\":\"<p>Call both the engagement team and the MD, see if either suggest alternative meeting arrangements.<\\/p>\",\"category\":\"1\"}}', '2018-07-02 16:04:10', 1),
(4, '<p>Everyone in your department has received a new computer system except for you. What would you do?<br />&nbsp;</p>', '{\"option1\":{\"option\":\"<p>Assume this is a mistake and speak to your manager.<\\/p>\",\"category\":\"1\"},\"option2\":{\"option\":\"<p>Confront your manager regarding why you are being treated unfairly.<\\/p>\",\"category\":\"2\"},\"option3\":{\"option\":\"<p>Take a new computer from one of your colleagues.<\\/p>\",\"category\":\"4\"},\"option4\":{\"option\":\"<p>Complain to the Human Resources department.<\\/p>\",\"category\":\"3\"},\"option5\":{\"option\":\"<p>Quit<\\/p>\",\"category\":\"5\"}}', '2018-07-02 16:04:10', 1),
(5, '<p>The human resource (HR) department&#39;s internal admin team is currently understaffed, so you have been seconded by the HR team to support their internal administrative requirements. However, you have received almost no training in HR related policies, practices or procedures, and you are struggling to keep up with the HR admin team. Although this position is temporary, it is likely you will need to remain in this role for at least a year. How you will respond to this situation?</p>', '{\"option1\":{\"option\":\"<p>Intentionally deviate from HR procedures, ensuring you are transferred back to the admin team.<\\/p>\",\"category\":\"3\"},\"option2\":{\"option\":\"<p>Take no further action, if you make any mistakes then blame the HR team for providing insufficient training.<\\/p>\",\"category\":\"4\"},\"option3\":{\"option\":\"<p>Request additional HR training to bring you up to speed with the rest of the HR admin team.<\\/p>\",\"category\":\"1\"},\"option4\":{\"option\":\"<p>Request to be assigned an experienced HR professional as a mentor to guide you through HR related processes.<\\/p>\",\"category\":\"2\"}}', '2018-07-02 16:05:01', 1),
(6, '<p>You are aware that large amounts of company property have been going missing over the past couple of weeks. You have noticed one of your colleagues putting stationery and other equipment from the office into her bag on a number of occasions and suspect that she is responsible.</p>', '{\"option1\":{\"option\":\"<p>Gather more evidence and catch her red-handed.<\\/p>\",\"category\":\"4\"},\"option2\":{\"option\":\"<p>Try to talk to your colleague and ask her about what you have noticed.<br \\/>&nbsp;<\\/p>\",\"category\":\"1\"},\"option3\":{\"option\":\"<p>Inform your manager that you suspect your colleague is stealing.<\\/p>\",\"category\":\"2\"},\"option4\":{\"option\":\"<p>Dont do anything. If guilty your colleague will be caught.<\\/p>\",\"category\":\"5\"},\"option5\":{\"option\":\"<p>Privately ask some of your colleagues if they have noticed anything suspicious recently.<br \\/>&nbsp;<\\/p>\",\"category\":\"3\"}}', '2018-07-02 16:05:22', 1),
(7, '<p>You provide administration support to a large team of engineers, particularly regarding pay and working hours. Engineers are required to fill out time-sheets, outlining working hours, billable hours and paid overtime. Last month, as a favour to a particular engineer who was experiencing personal problems, you filled out his weekly time-sheet on his behalf, saving him the effort. Now, the rest of the engineers are passing this responsibility on to you, which is not part of your job description and is interfering with your designated workload. How you will respond to this situation?</p>', '{\"option1\":{\"option\":\"<p>Intentionally fill out the engineer&#39;s time-sheets incorrectly, ensuring they do not ask again.<\\/p>\",\"category\":\"2\"},\"option2\":{\"option\":\"<p>Take no action and continue filling out the engineer&#39;s time-sheets for them.<\\/p>\",\"category\":\"4\"},\"option3\":{\"option\":\"<p>Offer to continue filling out the time-sheets, but only if they secretly pay you for your time.<\\/p>\",\"category\":\"3\"},\"option4\":{\"option\":\"<p>Remind them of their responsibility to complete time-sheets, and refuse future requests.<\\/p>\",\"category\":\"1\"}}', '2018-07-02 16:06:25', 1),
(8, '<p>At the end of a busy day at work, you accidentally send an e-mail containing an attachment with some confidential client information to the wrong person.</p>', '{\"option1\":{\"option\":\"<p>Decide to leave the office and deal with any problems tomorrow.<br \\/>&nbsp;<\\/p>\",\"category\":\"4\"},\"option2\":{\"option\":\"<p>Find your manager, explain what has happened to them and let them deal with any problems.<br \\/>&nbsp;<\\/p>\",\"category\":\"2\"},\"option3\":{\"option\":\"<p>Decide to overlook your error, send the e-mail to the correct person and leave things like that.<br \\/>&nbsp;<\\/p>\",\"category\":\"3\"},\"option4\":{\"option\":\"<p>Immediately send a follow up email to the &quot;wrong&quot; person, or if possible telephone them explaining your mistake. Then send the email to the correct person.<\\/p>\",\"category\":\"1\"}}', '2018-07-02 16:06:25', 1),
(9, '<p>You are a department manager and you have recently thought of a new procedure that you believe would improve the work process. Some of the employees in your department agree with the change and some do not. One of your employees openly criticises the idea to your director. What would you do?</p>', '{\"option1\":{\"option\":\"<p>You decide not to respond to the critics in order to avoid unnecessary conflict.<br \\/>&nbsp;<\\/p>\",\"category\":\"3\"},\"option2\":{\"option\":\"<p>You reprimand the employee for going over your head to the director and work to promote your idea with even more enthusiasm.<\\/p>\",\"category\":\"2\"},\"option3\":{\"option\":\"<p>You meet the employee for a talk and explain that bypassing your authority is unacceptable.<br \\/>&nbsp;<\\/p>\",\"category\":\"1\"},\"option4\":{\"option\":\"<p>Employee(s) trust in their manager is important so you decide to implement only some of the changes to keep my employees satisfied.<\\/p>\",\"category\":\"4\"}}', '2018-07-02 16:07:22', 1),
(10, '<p>Your primary equipment supplier has complained of underpayments from your organisation, stating that invoices have been ignored or underpaid. Based on your internal accounting software, everything seems to be balanced, and you are fairly confident that all payments are up-to-date. Your supplier however, has recently adopted new accounting software, and you suspect this account imbalance is simply due to human error on their part, but you can&#39;t be completely sure. How will you respond to this situation?</p>', '{\"option1\":{\"option\":\"<p>Ignore the supplier&#39;s request, allowing them to identify the source of the error internally.<\\/p>\",\"category\":\"4\"},\"option2\":{\"option\":\"<p>Request a full list of costs and cross-reference this with your accounting software.&nbsp;<\\/p>\",\"category\":\"1\"},\"option3\":{\"option\":\"<p>Send the supplier a full list of payments made, so they can cross-reference with their accounting software.<\\/p>\",\"category\":\"3\"},\"option4\":{\"option\":\"<p>Request a list of outstanding or underpaid invoices, closely investigate these payments.<\\/p>\",\"category\":\"2\"}}', '2018-07-02 16:07:22', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `psychometricEvaluationQuestions`
--
ALTER TABLE `psychometricEvaluationQuestions`
  ADD PRIMARY KEY (`psychometricEvaluationQuestionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `psychometricEvaluationQuestions`
--
ALTER TABLE `psychometricEvaluationQuestions`
  MODIFY `psychometricEvaluationQuestionID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
