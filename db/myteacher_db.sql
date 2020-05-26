-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.2.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for myteached_db
CREATE DATABASE IF NOT EXISTS `myteached_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `myteached_db`;

-- Dumping structure for table myteached_db.account
CREATE TABLE IF NOT EXISTS `account` (
  `Account_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_Name` varchar(100) DEFAULT NULL,
  `User_Name` varchar(50) NOT NULL,
  `User_Type` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Account_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.account: ~2 rows (approximately)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`Account_Id`, `Staff_Name`, `User_Name`, `User_Type`, `Password`, `Status`) VALUES
	(15, 'Naturinda Patrick', 'naturinda', 'Admin', '8051a599329ca19c35c17c3c5b1bc044', 1),
	(16, 'Andrew ', 'andrew', 'Staff', 'd914e3ecf6cc481114a3f534a5faf90b', 1);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;

-- Dumping structure for table myteached_db.child_protection_card
CREATE TABLE IF NOT EXISTS `child_protection_card` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Child_Name` varchar(100) DEFAULT NULL,
  `Year_Of_Birth` varchar(50) DEFAULT NULL,
  `Next_Of_Kin` varchar(100) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Religion` varchar(100) DEFAULT NULL,
  `Tribe` varchar(100) DEFAULT NULL,
  `Education` varchar(100) DEFAULT NULL,
  `Village` varchar(100) DEFAULT NULL,
  `Parish` varchar(100) DEFAULT NULL,
  `Sub_County` varchar(100) DEFAULT NULL,
  `District` varchar(100) DEFAULT NULL,
  `Disability` varchar(100) DEFAULT NULL,
  `Case_History` longtext DEFAULT NULL,
  `Other_History` varchar(100) DEFAULT NULL,
  `Status` int(11) DEFAULT 1,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.child_protection_card: ~0 rows (approximately)
/*!40000 ALTER TABLE `child_protection_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `child_protection_card` ENABLE KEYS */;

-- Dumping structure for table myteached_db.child_protection_policy
CREATE TABLE IF NOT EXISTS `child_protection_policy` (
  `Policy_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Policy` longtext DEFAULT NULL,
  `Class_Id` int(11) DEFAULT NULL,
  `Subject_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Policy_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.child_protection_policy: ~3 rows (approximately)
/*!40000 ALTER TABLE `child_protection_policy` DISABLE KEYS */;
INSERT INTO `child_protection_policy` (`Policy_Id`, `Policy`, `Class_Id`, `Subject_Id`) VALUES
	(4, '					       \r\n                                                					       \r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;margin-bottom:0cm;margin-bottom:.0001pt;" align="center"><b><span style="\\&quot;font-family:&quot;Times">MBARARA UNIVERSITY\r\nOF SCIENCE AND TECHNOLOGY</span></b></p><div align="center"><b><span style="\\&quot;font-family:&quot;Times"></span></b></div>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;margin-bottom:0cm;margin-bottom:.0001pt;" align="center"><b><span style="\\&quot;font-family:&quot;Times">FACULTY OF COMPUTING\r\nAND INFORMATICS SCIENCES</span></b></p><div align="center"><b><span style="\\&quot;font-family:&quot;Times"></span></b></div>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;margin-bottom:0cm;margin-bottom:.0001pt;" align="center"><b><span style="\\&quot;font-family:&quot;Times">ASSIGNMENT</span></b><b><span style="\\&quot;font-family:&quot;Times">&nbsp;</span></b></p><p class="\\&quot;MsoNormal\\&quot;" align="center"><span style="\\&quot;font-family:&quot;Times">CSC3203: EMERGING TRENDS IN\r\nCOMPUTER SCIENCE</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" align="center"><span style="\\&quot;font-family:&quot;Times">NAME: KATENDE LATIB</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" align="center"><span style="\\&quot;font-family:&quot;Times">REGNO: 2014/BCS/138/PS</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" align="center"><span style="\\&quot;font-family:&quot;Times">SIGNATURE:â€¦â€¦â€¦â€¦â€¦â€¦â€¦â€¦â€¦â€¦â€¦.</span></p><p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-size:11.0pt;color:#222222\\&quot;">Introduction</span></b></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;">Research indicates that 1.2 million deaths, 2.9 billion people\r\naffected, $1.7 trillion in damages. According to data from the United Nations\r\nOffice for Disaster Risk Reduction, these staggering figures are the total\r\neconomic and human impact of global disasters from 2002 to 2012. With a steady\r\ngrowth in annual disasters, especially climate related ones, emergency\r\nmanagement strategies are being put under the microscope. Disaster management\r\ntechnologies, on the other hand, have seen some remarkable breakthroughs in the\r\npast decade.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal\\&quot;"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-family:&quot;Times">How\r\ndrones fit?</span></b></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;">Many technological breakthroughs in recent\r\nyears have emerged in places areas where it was least expected. Unmanned aerial\r\nsystems, for example, have transitioned from highly defense focused\r\napplications to a multitude of commercial use cases that transcend industries.\r\nBut more commonly referred to as drones, fit for emergency response.</span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;">Drones are critically helpful in large scale\r\ndisaster zones. Drones, designed to be agile, fast and robust, empower response\r\nteams with a substantial upper hand without costing as much as manned flight\r\noperations. Because many are autonomously flown, drones can access hard to\r\nreach areas and perform data gathering tasks that are otherwise unsafe or\r\nimpossible for humans.</span><span style="\\&quot;font-size:11.5pt;font-family:&quot;Verdana&quot;,sans-serif;"></span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal;background:"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-family:&quot;Times">How\r\ndrones work?</span></b></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;margin-bottom:11.25pt;text-align:justify;line-height:"><span style="\\&quot;font-family:&quot;Times">Typically surveying natural\r\ndisasters like earthquakes, floods, and landslides involves putting boots on\r\nthe ground and using tools like measuring tape or GPS to take stock of how the\r\narea has been affected. As you might imagine this takes a significant amount of\r\ntime, is potentially dangerous, and it is costly.</span><span style="\\&quot;font-family:"> Drones with cameras, microphones and sensors search for\r\nvictims stranded in flooded homes and areas affected by natural disasters. They\r\nassess damage and send back images from places rescuers couldn\\\'t get.</span><span style="\\&quot;font-size:11.5pt;font-family:&quot;Helvetica&quot;,sans-serif;mso-fareast-font-family:"> </span><span style="\\&quot;font-family:&quot;Times">The\r\ndrones can help multiple relief efforts at once. One group may be using the\r\ndrones to search for survivors, while at the same time another organization or\r\ngroup can use different data to check their models of flooding in the storm\r\nsurge or radiation levels, and update that information to provide guidance to\r\nstill other groups and teams aiding in the relief and recovery efforts. The\r\nmore the drones are used, the more researchers can learn about how to improve\r\nthem.</span><span style="\\&quot;font-family:&quot;Times"></span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal;background:"><span style="\\&quot;font-family:&quot;Times">When time is of the essence\r\nand people are trapped in rubble and stranded in disaster situations the drone\r\ntechnology must be deployed to help in finding Individuals for Disaster and\r\nEmergency Response. The drone uses low-power radar to detect the small\r\nmovements from breathing and the heartbeat of a buried victim, even though\r\nseveral feet of rubble and debris.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal;background:"><span style="\\&quot;font-family:&quot;Times">The drone works by sending\r\nthe low-power radio signal which reflects off the debris being searched. The\r\nreflection from the rubble doesn\\\'t move. So it\\\'s not changing. But the\r\nreflection from the victim is moving because their heartbeat changes a little\r\nbit. We look for those tiny changes and then determine if they are from a human.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal;background:"><span style="\\&quot;font-family:&quot;Times">After an earthquake or any natural disaster has hit an\r\narea, drones take off flying in thirty minutes intervals and surveying the\r\naffected areas. They scan busted buildings and piles of rubble with visible\r\nlight, infrared, multispectral, and hyper spectral sensors. They relay those\r\ntime sensitive data and images to monitoring centers, so response teams can\r\npinpoint, then rush to save, anyone in need.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal;background:"><span style="\\&quot;font-family:&quot;Times">Although drones can help in\r\nrescue and recovery efforts, technological advancements are needed to&nbsp;</span><a href="http://127.0.0.1:81/&quot;https://www.wired.com/2017/01/swarms-drones-will-black-sun//&quot;"><span style="\\&quot;font-family:&quot;Times">strengthen\r\nthem against the risk of interference</span></a><span style="\\&quot;font-family:&quot;Times">, and\r\nthreats from harsh weather, bacteria, toxic materials, and explosions.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;margin-bottom:10.5pt;text-align:justify;line-height:"><span style="\\&quot;font-family:&quot;Times">Another\r\nconcern is that human involvement leads to human errors. The bottlenecks that\r\noccur after catastrophes when fatigued staff at monitoring centers are likely\r\nto miss vital information.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal;background:"><span style="\\&quot;font-family:&quot;Times">All these issues are both\r\nsolvable and worth solving, considering the capabilities drones offer to\r\nshorten response times, reduce the risk to rescue people affected, and save\r\nlives.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal;background:"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-family:&quot;Times">Why\r\nthe use of drones?</span></b></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;margin-bottom:7.5pt;text-align:justify;line-height:"><span style="\\&quot;font-family:&quot;Times">There\r\nare many safety and economic reasons to use drones before and after disasters\r\nin helping communities to recover and strengthening their resiliency.</span></p>\r\n\r\n<p class="\\&quot;MsoListParagraphCxSpFirst\\&quot;" style="\\&quot;mso-margin-top-alt:auto;mso-margin-bottom-alt:"><span style="\\&quot;font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:"><span style="\\&quot;mso-list:Ignore\\&quot;">Â·<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span></span><span style="\\&quot;font-family:&quot;Times">Drone\r\ntechnology can reduce disaster worker, claims adjuster, and risk engineer\r\nexposure to unnecessary danger.</span></p>\r\n\r\n<p class="\\&quot;MsoListParagraphCxSpMiddle\\&quot;" style="\\&quot;mso-margin-top-alt:auto;mso-margin-bottom-alt:"><span style="\\&quot;font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:"><span style="\\&quot;mso-list:Ignore\\&quot;">Â·<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span></span><span style="\\&quot;font-family:&quot;Times">Drones\r\nenhance the effectiveness of responders.</span></p>\r\n\r\n<p class="\\&quot;MsoListParagraphCxSpMiddle\\&quot;" style="\\&quot;mso-margin-top-alt:auto;mso-margin-bottom-alt:"><span style="\\&quot;font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:"><span style="\\&quot;mso-list:Ignore\\&quot;">Â·<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span></span><span style="\\&quot;font-family:&quot;Times">Drones\r\nprovide unique viewing angles not possible from manned aircraft.</span></p>\r\n\r\n<p class="\\&quot;MsoListParagraphCxSpMiddle\\&quot;" style="\\&quot;mso-margin-top-alt:auto;mso-margin-bottom-alt:"><span style="\\&quot;font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:"><span style="\\&quot;mso-list:Ignore\\&quot;">Â·<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span></span><span style="\\&quot;font-family:&quot;Times">Drone\r\ntechnology is highly deployable.</span></p>\r\n\r\n<p class="\\&quot;MsoListParagraphCxSpLast\\&quot;" style="\\&quot;mso-margin-top-alt:auto;mso-margin-bottom-alt:"><span style="\\&quot;font-family:Symbol;mso-fareast-font-family:Symbol;mso-bidi-font-family:"><span style="\\&quot;mso-list:Ignore\\&quot;">Â·<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\r\n</span></span></span><span style="\\&quot;font-family:&quot;Times">Drone\r\ntechnology is cost-efficient.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal\\&quot;"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-family:&quot;Times">Obstacles\r\nin traditional methods.</span></b></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;">Many disaster management protocols have been\r\ntested over the years. While many of these strategies have been successful, they\r\nalso come with major difficulties. Time is the most important commodity in\r\ndisaster response. Emergency responders know very well the irreversible\r\nconsequences of critical delays, so their playbooks are inherently designed to\r\naddress urgent, high pressure scenarios. On top of urgency, disaster response\r\nfaces another major challenge in logistics, as evidenced by the<span class="\\&quot;apple-converted-space\\&quot;">&nbsp;</span></span><a href="http://127.0.0.1:81/&quot;http://edition.cnn.com/2015/04/25/asia/nepal-earthquake-7-5-magnitude//&quot;"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;">7.8 magnitude\r\nearthquake</span></a><span class="\\&quot;apple-converted-space\\&quot;"><span style="\\&quot;font-size:">&nbsp;</span></span><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;">in Nepal [2] that\r\nclaimed the lives of 9,000 people and injured 23,000 others.</span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;">As debris and rubble piled up on the streets\r\nfollowing the biggest natural disaster in the country since 1934, most of the roads\r\nwere blocked, denying access to outlying areas. In situations like this where\r\nland access is off the table, government agencies are forced to deploy manned\r\naircraft to continue immediate search and rescue, and later on, relief efforts.\r\nIn theory, this sounds like a winner, but resource allocation, especially in\r\npoorer countries, poses another major challenge. Search &amp; rescue operations\r\nfrom the air are expensive, and as weâ€™ve seen in the past, these operations can\r\nstretch for months, even years. In countries where resources are already\r\nscarce, this option is not viable.</span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;">Outside of these safety concerns, thereâ€™s\r\nanother major hurdle that is often overlooked first responder safety. In the\r\ncase of earthquakes, landslides, hurricanes and wildfires, first responders are\r\ndeployed immediately in rough and dangerous working conditions. In 2014, a\r\nmudslide roared through the rural community of Oso, Washington, destroying over\r\n30 homes and taking the lives of 43 residents. The response team had to move\r\nquickly. The risk of another mudslide was looming over them, while the first\r\none dammed the river and flooded the valley, essentially turning the entire\r\ndisaster zone into quicksand. Given all these uncontrollable elements, it was\r\nnot safe for the ground crew to investigate the scene. To make things worse,\r\nonly 30 minutes of clear skies were left for helicopters to conduct an aerial\r\nsurvey â€“ not enough time to gain an accurate account of what was happening on\r\nthe ground. The team did, however, have a drone.</span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:">Immediately following the Oso mudslide [4],<span class="\\&quot;apple-converted-space\\&quot;">&nbsp;</span></span><a href="http://127.0.0.1:81/&quot;http://geoawesomeness.com/precisionhawk-develops-data-safety-tools-take-drone-use-next-level//&quot;" target="\\&quot;_blank\\&quot;"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;">Precision\r\nHawk</span></a><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;">\r\nan information company out of Raleigh that manufactures a drone for data\r\ncollection and software for processing and analysis, was called in through\r\ninvolvement with Roboticists Without Borders (RWB) to provide geologists and\r\nfirst-responders with actionable insights. Precision Hawk surveyed the terrain\r\nfrom the air to create a 3D map acts like a plane. Itâ€™s smarter than a plane\r\nbecause itâ€™s got all sorts of onboard electronics to let it do pre-programmed\r\nsurveys. It takes pictures like on a satellite or a Mars explorer and then\r\npulls those back together into a hyper-accurate map a 3D reconstruction.</span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:">In Oso,<span class="\\&quot;apple-converted-space\\&quot;">&nbsp;</span></span><a href="http://127.0.0.1:81/&quot;http://www.precisionhawk.com//&quot;" target="\\&quot;_blank\\&quot;"><span style="\\&quot;font-size:">Precision Hawk</span></a><span class="\\&quot;apple-converted-space\\&quot;"><span style="\\&quot;font-size:11.0pt;color:black;">&nbsp;</span></span><span style="\\&quot;font-size:11.0pt;">used high fidelity sensors and intelligent\r\nback-end software to reconstruct and analyze the terrain in 3D a step that not\r\nonly helped geologists detect the pace of land movement but also provided first\r\nresponders the time-sensitive data they needed to safely infiltrate the\r\ndisaster zone. This all happened in a matter of hours. Historically, emergency response\r\nteams used manned flights and satellite information to gather such data,\r\nactions that are costly and take days to weeks to accomplish.</span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:">Beyond economic and logistical advantages, drones currently on the\r\nmarket are often equipped with intelligent flight planning software that allows\r\nfirst responders to easily create highly customizable flight paths that focus\r\non specific areas of interest, leading to organized and focused search efforts.</span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:">Additionally, drones are also outfitted with various sensor options that\r\ninclude visual, thermal hyper spectral and multispectral. Why are these\r\nimportant? In earthquakes and landslides, these sensors can be flown to conduct\r\nground truthing surveys. The thermal sensor, for example, is perfectly suited\r\nfor detecting the heat a human body emits, which helps locate survivors.\r\nVarious sensors suites are efficient in obtaining data to create an exact 3D\r\nreconstruction of disaster zones, which when compared with historical data from\r\nsatellites, offers new perspectives on the extent of damage, and terrain or\r\nfield deviation that could help manage future disasters.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:normal\\&quot;"><a name="\\&quot;_Toc477263928\\&quot;"><span style="\\&quot;font-family:&quot;Times">Vision</span></a><span style="\\&quot;font-family:&quot;Times"></span></p>\r\n\r\n<p class="\\&quot;app-feature-body\\&quot;" style="\\&quot;margin:0cm;margin-bottom:.0001pt;text-align:"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:">The drone with a high resolution camera which sees everything. The high\r\nresolution camera takes photos of the lost people and landscape, photos and\r\nlocation of suspicious objects are sent to the rescue group leader.</span></p>\r\n\r\n<p class="\\&quot;app-feature-body\\&quot;" style="\\&quot;margin:0cm;margin-bottom:.0001pt;text-align:"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:">&nbsp;</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:normal\\&quot;"><a name="\\&quot;_Toc477263929\\&quot;"><span style="\\&quot;font-family:&quot;Times">Human detection</span></a><span style="\\&quot;font-family:&quot;Times"></span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal\\&quot;"><span style="\\&quot;font-family:&quot;Times">The drone has thermal imager which is mounted on a drone that\r\nallows it to locate personâ€™s heat emitting even in low visibility situations.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:normal\\&quot;"><a name="\\&quot;_Toc477263930\\&quot;"><span style="\\&quot;font-family:&quot;Times">Obstacle Avoidance</span></a><span style="\\&quot;font-family:&quot;Times"></span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal\\&quot;"><span style="\\&quot;font-family:&quot;Times">Despite of the geographical conditions, the drone easily\r\nrises to the highest buildings, detects and avoids obstacles on its way.\r\nForests and buildings are not obstacles for the drone to perform the work.</span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:normal\\&quot;"><a name="\\&quot;_Toc477263931\\&quot;"><span style="\\&quot;font-family:&quot;Times">Durability</span></a><span style="\\&quot;font-family:&quot;Times"></span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal\\&quot;"><span style="\\&quot;font-family:&quot;Times">Weather will not a problem. The drone can be used in every\r\nweather condition despite of the weather conditions in form of rain, snow,\r\nstrong winds and fog.</span><span style="\\&quot;font-family:&quot;Times"></span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:normal\\&quot;"><a name="\\&quot;_Toc477263932\\&quot;"><span style="\\&quot;font-family:&quot;Times">Control</span></a><span style="\\&quot;font-family:&quot;Times"></span></p>\r\n\r\n<p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:justify;line-height:normal\\&quot;"><span style="\\&quot;font-family:&quot;Times">The drone controlled from the\r\ndesktop application which automatically calculates the optimal route for person\r\nsearch in a given area. It can detect heat which radiates from a person and\r\nalso can detect suspicious objects and sends photos of them to the rescue team.</span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;">References</span></b></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;"><span style="\\&quot;mso-list:Ignore\\&quot;">1.<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><a href="http://127.0.0.1:81/&quot;https://en.wikipedia.org/wiki/2014_Oso_mudslide/&quot;"><span style="\\&quot;font-size:">https://en.wikipedia.org/wiki/2014_Oso_mudslide</span></a><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;"></span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;"><span style="\\&quot;mso-list:Ignore\\&quot;">2.<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><a href="http://127.0.0.1:81/&quot;https://en.wikipedia.org/wiki/April_2015_Nepal_earthquake/&quot;"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;">https://en.wikipedia.org/wiki/April_2015_Nepal_earthquake</span></a><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;"></span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;"><span style="\\&quot;mso-list:Ignore\\&quot;">3.<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><a href="http://127.0.0.1:81/&quot;https://www.virgin.com/virgin-unite/business-innovation/humanitarian-in-the-sky-drones-for-disaster-response/&quot;"><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;">https://www.virgin.com/virgin-unite/business-innovation/humanitarian-in-the-sky-drones-for-disaster-response</span></a><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;"></span></p>\r\n\r\n<p style="\\&quot;margin-top:0cm;margin-right:0cm;margin-bottom:19.5pt;margin-left:"><span style="\\&quot;font-size:11.0pt;"><span style="\\&quot;mso-list:Ignore\\&quot;">4.<span style="\\&quot;font:7.0pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><span style="\\&quot;font-size:11.0pt;color:black;mso-themecolor:text1\\&quot;">https://en.wikipedia.org/wiki/United_Nations_International_Strategy_for_Disaster_Reduction</span></p>\r\n\r\n                                                ', 1, 2),
	(5, '					       \r\n                                                <h3 align="center"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-size:18.0pt;line-height:">MBARARA UNIVERSITY\r\nOF SCIENCE AND TECHNOLOGY</span></b></h3><h3 align="center">\r\n\r\n</h3><h3 class="\\&quot;MsoNormal\\&quot;" align="center"><b style="\\&quot;mso-bidi-font-weight:"><span style="\\&quot;font-size:16.0pt;line-height:107%;font-family:&quot;Times">FACULTY\r\nOF COMPUTER SCIENCE</span></b></h3><h3 align="center">\r\n\r\n</h3><h3 align="center"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-size:18.0pt;line-height:">COMPILER\r\nCONSTRUCTION</span></b></h3><h3 align="center">\r\n\r\n</h3><h3 align="center"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-size:18.0pt;line-height:">NIWAHA BARNABAS <span style="\\&quot;mso-spacerun:yes\\&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>2014BCS007</span></b></h3><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;text-align:center\\&quot;" align="\\&quot;center\\&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="\\&quot;font-size:18.0pt;line-height:107%;font-family:&quot;Times">HASH\r\nTABLES ASSIGNMENT</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="\\&quot;font-size:18.0pt;line-height:107%;font-family:">ANSWERS</span></p><p>\r\n\r\n</p><h1 style="\\&quot;line-height:150%\\&quot;"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-size:12.0pt;line-height:150%;font-family:&quot;Times">Introduction</span></b></h1><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;"><span style="\\&quot;mso-tab-count:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Both linear lists and hash tables are 2 symbol table\r\nmechanisms and basically we evaluate each scheme on basis of the required time\r\nand space to add say n number of entries and make say<span style="\\&quot;mso-spacerun:yes\\&quot;">&nbsp; </span>r inquiries<span style="\\&quot;mso-no-proof:"><span style="\\&quot;mso-spacerun:yes\\&quot;">&nbsp;</span>[1]</span>. </span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">Unlike the linear lists\r\nthat are simple to implement but with its performance especially when the r and\r\nn entries get very large, Hashing schemes provide better performance for some\r\nwhat greater programming effort and space over head<span style="\\&quot;mso-no-proof:yes\\&quot;"><span style="\\&quot;mso-spacerun:yes\\&quot;">&nbsp;</span>[2]</span>.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">It is useful for a\r\ncompiler to be able to grow the symbol table dynamically in case it is needed\r\nat compilation time. If the size of the symbol table is fixed when the compiler\r\nis written, then the size must be chosen large enough to handle any source\r\nprogram that might be presented. Such a fixed size is likely to be too large\r\nfor most and inadequate for such a program.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">Hashing has various forms\r\nincluding the following: <span class="\\&quot;mw-headline\\&quot;"><b style="\\&quot;mso-bidi-font-weight:">Open addressing, Coalesced hashing, Cuckoo hashing</b></span><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;">,<span class="\\&quot;renderedqtext\\&quot;"> </span><span class="\\&quot;mw-headline\\&quot;">Hopscotch hashing, Robin Hood hashing, 2-choice hashing<span style="\\&quot;mso-no-proof:yes\\&quot;"><span style="\\&quot;mso-spacerun:yes\\&quot;">&nbsp;</span></span><span style="\\&quot;font-weight:normal;mso-no-proof:yes\\&quot;">[3]</span>.</span></b></span></p><p>\r\n\r\n</p><h1 style="\\&quot;line-height:150%\\&quot;"><b style="\\&quot;mso-bidi-font-weight:normal\\&quot;"><span style="\\&quot;font-size:12.0pt;line-height:150%;font-family:&quot;Times">Hash Table</span></b></h1><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span class="\\&quot;renderedqtext\\&quot;"><span style="\\&quot;font-size:12.0pt;line-height:150%;font-family:&quot;Times">A\r\n<b>hash table </b>/ <b>hash map</b>: is a data structure used to implement an\r\nassociative array, a structure that can map keys to values<span style="\\&quot;mso-no-proof:yes\\&quot;"><span style="\\&quot;mso-spacerun:yes\\&quot;">&nbsp;</span></span><span style="\\&quot;mso-no-proof:yes\\&quot;">[3]</span>. </span></span><span style="\\&quot;font-size:12.0pt;line-height:150%;font-family:&quot;Times"><span style="\\&quot;mso-spacerun:yes\\&quot;">&nbsp;</span>One can say just an array associated with a\r\nhash function.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">Under hashing we have\r\nopen hashing that is also known as â€œopenâ€ because there is no limit on the\r\nnumber of entries to be made in the table.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">In this scheme, we are\r\ngiven the capability of performing say n inquiries on r names, In time\r\nproportional to n (n + r)/m for any constant m of our choosing. Since m can be\r\nmade as large as up to n, makes the method more efficient<span style="\\&quot;mso-no-proof:yes\\&quot;"><span style="\\&quot;mso-spacerun:yes\\&quot;">&nbsp;</span>[1]</span>.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">Space taken by the data\r\nstructure grows with m, thus time-space trake of involved.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">Consider an example\r\nbelow, We are given </span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;"><span style="\\&quot;mso-tab-count:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>A hash table consisting of a fixed array of m pointers to\r\ntable entries.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;"><span style="\\&quot;mso-tab-count:">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Table entries organized into m separate linked lists called\r\nbuckets And Each record in the table appears exactly one of the lists.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">Storage for the records\r\nmay be drawn from an array of records or even dynamic storage allocation\r\nfacilitates of the implementation language can be used to obtain space for the\r\nrecords that often leads to inefficiency. </span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">To determine whether\r\nthere an empty for an entry for string s in the symbol table, we apply a hash\r\nfunction h to s, such that h(s) returns an integer between 0 and m-1.</span></p><p>\r\n\r\n</p><p class="\\&quot;MsoNormal\\&quot;" style="\\&quot;line-height:150%\\&quot;"><span style="\\&quot;font-size:12.0pt;">If s in the table, then\r\nit is on the list numbered h(s), else it is entered by creating a record for s\r\nthat is linked at the front of the list numbered h(s).</span></p>', 2, 4),
	(7, '					       \r\n                                                <p><b>Anatomy</b> (Greek anatomÄ“, \\\'dissection\\\') is the branch of <a href=\\"https://en.wikipedia.org/wiki/Biology\\" title=\\"Biology\\">biology</a> concerned with the study of the structure of organisms and their parts.<sup id=\\"cite_ref-1\\" class=\\"reference\\"><a href=\\"https://en.wikipedia.org/wiki/Anatomy#cite_note-1\\">[1]</a></sup>\r\n Anatomy is a branch of natural science which deals with the structural \r\norganization of living things. It is an old science, having its \r\nbeginnings in prehistoric times.<sup id=\\"cite_ref-2\\" class=\\"reference\\"><a href=\\"https://en.wikipedia.org/wiki/Anatomy#cite_note-2\\">[2]</a></sup> Anatomy is inherently tied to <a href=\\"https://en.wikipedia.org/wiki/Developmental_biology\\" title=\\"Developmental biology\\">developmental biology</a>, <a href=\\"https://en.wikipedia.org/wiki/Embryology\\" title=\\"Embryology\\">embryology</a>, <a href=\\"https://en.wikipedia.org/wiki/Comparative_anatomy\\" title=\\"Comparative anatomy\\">comparative anatomy</a>, <a href=\\"https://en.wikipedia.org/wiki/Evolutionary_biology\\" title=\\"Evolutionary biology\\">evolutionary biology</a>, and <a href=\\"https://en.wikipedia.org/wiki/Phylogeny\\" class=\\"mw-redirect\\" title=\\"Phylogeny\\">phylogeny</a>,<sup id=\\"cite_ref-intro_HGray_3-0\\" class=\\"reference\\"><a href=\\"https://en.wikipedia.org/wiki/Anatomy#cite_note-intro_HGray-3\\">[3]</a></sup>\r\n as these are the processes by which anatomy is generated over immediate\r\n (embryology) and long (evolution) timescales. Anatomy and <a href=\\"https://en.wikipedia.org/wiki/Physiology\\" title=\\"Physiology\\">physiology</a>, which study (respectively) the structure and <a href=\\"https://en.wikipedia.org/wiki/Function_(biology)\\" title=\\"Function (biology)\\">function</a> of organisms and their parts, make a natural pair of <a href=\\"https://en.wikipedia.org/wiki/Multidisciplinary_approach\\" class=\\"mw-redirect\\" title=\\"Multidisciplinary approach\\">related disciplines</a>, and they are often studied together. <a href=\\"https://en.wikipedia.org/wiki/Human_body\\" title=\\"Human body\\">Human anatomy</a> is one of the essential <a href=\\"https://en.wikipedia.org/wiki/Basic_sciences\\" class=\\"mw-redirect\\" title=\\"Basic sciences\\">basic sciences</a> that are <a href=\\"https://en.wikipedia.org/wiki/Applied_science\\" title=\\"Applied science\\">applied</a> in <a href=\\"https://en.wikipedia.org/wiki/Medicine\\" title=\\"Medicine\\">medicine</a>.<sup id=\\"cite_ref-4\\" class=\\"reference\\"><a href=\\"https://en.wikipedia.org/wiki/Anatomy#cite_note-4\\">[4]</a></sup></p><p><sup id=\\"cite_ref-4\\" class=\\"reference\\"><img src=\\"data:image/png;base64,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AP3jAP3jAP3iAP7hAP/7AP//AJiNAFdSg+nu////+1pZgVNTfuzs8fLy9evr8P///////////////////////////////////////wH///8AAAAAAAAAAAAAAAAAAAAAAAAAAADT09/V1uHEwtPw8PObm3AJCgprbbIiEVFzgv4A8wD+7gAAAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/wACAwAAGgDGuQCUmmxfa44mIOMhIiKjo7y8vM6VlG0JCgcDAwIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAAAAA5+fubWyUBgYEVlc/VFQ+CQoKcXW7KBRPbX8AAOkA/vkAAAMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAEA/v4AAOEAOkcACAeUfIb9pq6WAAD72tnkDAwImpu2ZGNIDg8LAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAABISDGRlSgMDAgMDAxAQDI6S3A/2UG1/AADoAP76AAACAAAAAAAAAAAAAAAAAAD9AAIIAAIPAAD/AAAAAAAAAAAAAAAAAAAAAAADAP7gADJAAHlql1RRg/n8BYOEYPv6/NfX4AYHBgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD////////////////////////19fj////////Oz9v39vO+w/5aTi//9wD/7AD94gD94wD94wD94wD94wD/5QD/6QD/7AD13AXt1Q3/6wD/6wD/5gD+4gD94wD94wD94wD94wD94AD//wCUfAB0ecX///+mpr5FRXO5ucv///////////////////////////////////8CAAAAAAAAAAAAAAAAAAAAAAAA1dXggYGkr67EEQ8MCAkMmpSBgXXRAAUA/vQAAQIAAgMAAgYAAg4AAggA9fQA5eQO8P8Uj5oZOVBE7OoB5Ocb7+0AAQMAAg8AAggAAgQAAgEAAAIAAOcAa4IA7t5m0dYARkYyNTUp3Nzm4uLqAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAAAAAAANfX4svL2fX19s7P2yAhGI6S3DYhgyQ8AP7kAAADAP39Afz8APb0AOHbEt/lTvMHnQUc4wIG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adDQ3ayswwAAABQTDoaFYjQ3Zd/e6Fo9T8tZx2ERa/Lm+9Tq1eIG2O3l9ul6I+yaF+7q9eT+39bj3e0n2VmNKsNttCjQRf4G/zQ6JNTV4BkYEi0uIQsLCMLC04WGYgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADk5Os/P3OamnFDQzF7ep4xMiLe3urp6O6MhWgBCQDj6em+5r3R/8nKlPLrqg0FIfcpKR4bGRQUGA1YbTgkDCQAAAA0NGpCQjGKimWvr8QlJRwODgpvbpaTlGwcHBQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA////////////////////////////////////////ysrYHBxZsbHG////////ODdtLS1lxcXUwMDS/fP///b/9+L/9+3+5+js8vL1qKi/w8PT////9+/91tPioaG6YmGLWlqGv7/R////z8/bWVmF2dnj////////////////////////////////////////////////A4CAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABsbFD4+LWRkjvj5+jw7LBYVD1JTPebl7WhnigQJBKaqvszV2EVLMAwMCr6+z6+vxRERDAYGBZmcssnL2P//AAgHBioqHzs7K62tw6inwISFYSMjGgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA0NCbIyJO7u85NTX0yMyY+Pi0KCwcYGRQeHhf8/P1NTzgAAAAAAACam7dWVj/5+fu8vM4ICQbp6O9JSTWCg19LSzaTkq/Q0N2XmG8fHxcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAioqqwcHRJiYaaWlOJiYdAAAAubnM5eXsDAwJVlY/wsLTra3D/f3+f39dEREM3d3nDw4JnJ242dnkPT0sZmZLAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAPLy9Y+PrOHh6BsbFRkZFDg4Kebl7SorHyIiGQAAAPf3+uPi6vP099jY4ujn7NLT3hobFnNyVBQUDwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC6usvNzNvs7fMJCgf9/P3u7vP/AAAODAn/AAD19vgQDwsxMSNOTjoJCQcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABAAD//1SPrKFuLum9AAAAAElFTkSuQmCC\\" alt=\\"\\"></sup></p>', 5, 5);
/*!40000 ALTER TABLE `child_protection_policy` ENABLE KEYS */;

-- Dumping structure for table myteached_db.class
CREATE TABLE IF NOT EXISTS `class` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Class_Name` varchar(50) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.class: ~6 rows (approximately)
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` (`Id`, `Class_Name`, `Status`) VALUES
	(1, 'Set5', 1),
	(2, 'set6', 1),
	(3, 'set7', 1),
	(4, 'set8', 1),
	(5, 'set9', 1),
	(6, 'fdfgd', 0);
/*!40000 ALTER TABLE `class` ENABLE KEYS */;

-- Dumping structure for table myteached_db.institution
CREATE TABLE IF NOT EXISTS `institution` (
  `Instiution_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Phone1` tinytext DEFAULT NULL,
  `Hospital_Name` text DEFAULT NULL,
  `Hospital_Motto` text DEFAULT NULL,
  `Logo` varchar(50) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Phone2` tinytext DEFAULT NULL,
  `Diocese` text DEFAULT NULL,
  `Email` text DEFAULT NULL,
  PRIMARY KEY (`Instiution_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.institution: ~0 rows (approximately)
/*!40000 ALTER TABLE `institution` DISABLE KEYS */;
INSERT INTO `institution` (`Instiution_Id`, `Phone1`, `Hospital_Name`, `Hospital_Motto`, `Logo`, `Address`, `Phone2`, `Diocese`, `Email`) VALUES
	(11, '(+256)(0) (323) 880-242', 'C.O.U.BWINDI COMMUNITY HOSPITAL', 'WE TREAT GOD HEALS', 'id logo.jpg', 'P.O BOX 58 KANUNGU, UGANDA', '(+256)(0) (703) 342-891', 'KINKIZI DIOCESE', 'bwindicommmunityhospital@gmail.com');
/*!40000 ALTER TABLE `institution` ENABLE KEYS */;

-- Dumping structure for table myteached_db.issuing_signature
CREATE TABLE IF NOT EXISTS `issuing_signature` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Signature_Image` text DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.issuing_signature: ~0 rows (approximately)
/*!40000 ALTER TABLE `issuing_signature` DISABLE KEYS */;
/*!40000 ALTER TABLE `issuing_signature` ENABLE KEYS */;

-- Dumping structure for table myteached_db.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Log` text DEFAULT NULL,
  `Time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=548 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.logs: ~74 rows (approximately)
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`Id`, `Log`, `Time`) VALUES
	(474, 'Naturinda Patrick  edited DR.KATE information', '2020-05-22 12:06:47'),
	(475, 'Naturinda Patrick  edited DR.KATES information', '2020-05-22 12:06:57'),
	(476, 'Naturinda Patrick  edited DR.KATE information', '2020-05-22 12:09:14'),
	(477, 'Naturinda Patrick  edited DR.KATE information', '2020-05-22 12:10:17'),
	(478, 'Naturinda Patrick  edited DR.KATE information', '2020-05-22 12:15:06'),
	(479, 'Andrew   registered a new staff :', '2020-05-22 18:14:37'),
	(480, 'Andrew   registered a new staff :', '2020-05-22 18:14:38'),
	(481, 'Andrew   registered a new staff :', '2020-05-22 18:14:38'),
	(482, 'Andrew   registered a new staff :', '2020-05-22 18:15:44'),
	(483, 'Andrew   registered a new staff :', '2020-05-22 18:18:25'),
	(484, 'Andrew   edited Set5 to Set51', '2020-05-22 18:19:54'),
	(485, 'Andrew   edited Set51 to Set5', '2020-05-22 18:20:10'),
	(486, 'Andrew   registered a new staff :', '2020-05-22 18:20:25'),
	(487, 'Andrew   deleted fdfgds information', '2020-05-22 18:22:22'),
	(488, 'Andrew   registered a new staff :ANDREW', '2020-05-23 10:35:51'),
	(489, 'Andrew   registered a new question :', '2020-05-23 13:06:13'),
	(490, 'Andrew   registered a new question :', '2020-05-23 13:17:20'),
	(491, 'Andrew   registered a new question :', '2020-05-23 13:17:59'),
	(492, 'Andrew   edited first question to jkgsfikshflshf smbkslfs', '2020-05-23 13:18:28'),
	(493, 'Andrew   edited dgdgsdgd to dgdgsdgddd', '2020-05-23 13:19:32'),
	(494, 'Andrew   edited dgdgsdgddd to dgdgsdgddds', '2020-05-23 13:22:03'),
	(495, 'Andrew   edited dgdgsdgddds to dgdgsdgdddsz', '2020-05-23 13:23:34'),
	(496, 'Andrew   edited dgdgsdgdddsz to dgdgsdgddd', '2020-05-23 13:24:16'),
	(497, 'Andrew   edited dgdgsdgddd to dgdgsdgdddb', '2020-05-23 13:25:14'),
	(498, 'Andrew   edited jkgsfikshflshf smbkslfs to jkgsfikshflshf smbkslfsb', '2020-05-23 13:25:41'),
	(499, 'Andrew   edited jkgsfikshflshf smbkslfsb to nutrition quetion 1', '2020-05-23 15:40:06'),
	(500, 'Andrew   edited sfsdgdfgfhfghf to nutrition quetion 2', '2020-05-23 15:40:21'),
	(501, 'Andrew   registered a new question :', '2020-05-23 15:41:41'),
	(502, 'Andrew   registered a new staff :AGIREMBABAZI ANASTORIO', '2020-05-23 15:59:30'),
	(503, 'Andrew   registered a new staff :TUMUKUNDE AGUSTINE', '2020-05-23 16:01:41'),
	(504, 'Andrew   registered a new staff :AKANTORANA JACOB', '2020-05-23 16:05:10'),
	(505, 'Andrew   registered a new child protection answer :', '2020-05-23 16:29:12'),
	(506, 'Andrew   registered a new child protection answer :', '2020-05-23 16:29:12'),
	(507, 'Andrew   registered a new child protection answer :', '2020-05-23 16:29:13'),
	(508, 'Andrew   registered a new child protection answer :', '2020-05-23 16:30:20'),
	(509, 'Andrew   registered a new child protection answer :', '2020-05-23 16:30:20'),
	(510, 'Andrew   registered a new child protection answer :', '2020-05-23 16:30:20'),
	(511, 'Andrew   registered a new child protection answer :', '2020-05-23 16:33:05'),
	(512, 'Andrew   registered a new child protection answer :', '2020-05-23 16:33:05'),
	(513, 'Andrew   registered a new child protection answer :', '2020-05-23 16:33:05'),
	(514, 'Andrew   registered a new question :', '2020-05-23 16:58:37'),
	(515, 'Andrew   registered a new child protection answer :', '2020-05-23 16:59:43'),
	(516, 'Andrew   registered a new child protection answer :', '2020-05-23 16:59:43'),
	(517, 'Andrew   registered a new child protection answer :', '2020-05-23 16:59:43'),
	(518, 'Andrew   registered a new child protection answer :', '2020-05-23 17:03:29'),
	(519, 'Andrew   registered a new question :', '2020-05-25 16:58:25'),
	(520, 'Andrew   registered a new question :', '2020-05-25 16:58:25'),
	(521, 'Andrew   registered a new question :', '2020-05-25 16:58:25'),
	(522, 'Andrew   registered a new question :', '2020-05-25 16:58:26'),
	(523, 'Andrew   registered a new question :', '2020-05-25 16:58:26'),
	(524, 'Andrew   registered a new child protection answer :', '2020-05-25 17:00:26'),
	(525, 'Andrew   registered a new child protection answer :', '2020-05-25 17:00:26'),
	(526, 'Andrew   registered a new child protection answer :', '2020-05-25 17:00:26'),
	(527, 'Andrew   registered a new child protection answer :', '2020-05-25 17:00:27'),
	(528, 'Andrew   registered a new child protection answer :', '2020-05-25 17:01:59'),
	(529, 'Andrew   registered a new child protection answer :', '2020-05-25 17:01:59'),
	(530, 'Andrew   registered a new child protection answer :', '2020-05-25 17:01:59'),
	(531, 'Andrew   registered a new child protection answer :', '2020-05-25 17:02:00'),
	(532, 'Andrew   registered a new child protection answer :', '2020-05-25 17:04:36'),
	(533, 'Andrew   registered a new child protection answer :', '2020-05-25 17:04:36'),
	(534, 'Andrew   registered a new child protection answer :', '2020-05-25 17:04:36'),
	(535, 'Andrew   registered a new child protection answer :', '2020-05-25 17:04:36'),
	(536, 'Andrew   registered a new child protection answer :', '2020-05-25 17:06:41'),
	(537, 'Andrew   registered a new child protection answer :', '2020-05-25 17:06:41'),
	(538, 'Andrew   registered a new child protection answer :', '2020-05-25 17:06:41'),
	(539, 'Andrew   registered a new child protection answer :', '2020-05-25 17:06:41'),
	(540, 'Andrew   registered a new child protection answer :', '2020-05-25 17:09:19'),
	(541, 'Andrew   registered a new child protection answer :', '2020-05-25 17:09:19'),
	(542, 'Andrew   registered a new child protection answer :', '2020-05-25 17:09:19'),
	(543, 'Andrew   registered a new child protection answer :', '2020-05-25 17:09:19'),
	(544, 'Andrew   registered a new staff :DALLEN', '2020-05-25 17:17:39'),
	(545, 'Andrew   registered a new staff :DALLEN', '2020-05-25 17:18:47'),
	(546, 'Andrew   registered a new staff :DEUS', '2020-05-25 17:36:33'),
	(547, 'Andrew   registered a new staff :NATURINDA PATRICK KOSA', '2020-05-25 17:51:34');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Dumping structure for table myteached_db.marking_schedule
CREATE TABLE IF NOT EXISTS `marking_schedule` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `Subject_Id` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT 1,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.marking_schedule: ~4 rows (approximately)
/*!40000 ALTER TABLE `marking_schedule` DISABLE KEYS */;
INSERT INTO `marking_schedule` (`Id`, `Date`, `Subject_Id`, `Status`) VALUES
	(1, '2020-05-25', 1, 1),
	(2, '2020-05-24', 4, 1),
	(3, '2020-05-25', 2, 1),
	(4, '2020-05-25', 5, 1);
/*!40000 ALTER TABLE `marking_schedule` ENABLE KEYS */;

-- Dumping structure for table myteached_db.policy_answers
CREATE TABLE IF NOT EXISTS `policy_answers` (
  `Answer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Question_Id` int(11) DEFAULT NULL,
  `Answer` text DEFAULT NULL,
  `Status` int(11) DEFAULT 1,
  `Correct` int(11) DEFAULT 0,
  PRIMARY KEY (`Answer_Id`),
  KEY `Question_Id` (`Question_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.policy_answers: ~33 rows (approximately)
/*!40000 ALTER TABLE `policy_answers` DISABLE KEYS */;
INSERT INTO `policy_answers` (`Answer_Id`, `Question_Id`, `Answer`, `Status`, `Correct`) VALUES
	(142, 43, 'answer1', 1, 0),
	(143, 43, 'answer2', 1, 1),
	(144, 43, 'answer3', 1, 0),
	(145, 44, 'answer5', 1, 0),
	(146, 44, 'answe6', 1, 1),
	(147, 44, 'answe7', 1, 0),
	(148, 46, 'answer 1', 1, 0),
	(149, 46, 'answer2', 1, 1),
	(150, 46, 'answer3', 1, 0),
	(151, 47, 'wrong1', 1, 0),
	(152, 47, 'wrong2', 1, 0),
	(153, 47, 'correct', 1, 1),
	(154, 47, 'correct2', 1, 1),
	(155, 48, 'nucleus ', 1, 1),
	(156, 48, 'mitochondria', 1, 0),
	(157, 48, 'cell membrane ', 1, 0),
	(158, 48, 'micro villi', 1, 0),
	(159, 49, 'nucleus ', 1, 0),
	(160, 49, 'mitochondria', 1, 1),
	(161, 49, 'cell wall', 1, 0),
	(162, 49, 'extracellular space', 1, 0),
	(163, 50, 'bolus', 1, 1),
	(164, 50, 'food', 1, 0),
	(165, 50, 'chyme', 1, 0),
	(166, 50, 'stool', 1, 0),
	(167, 51, 'mouth- esophagus -stomach', 1, 1),
	(168, 51, 'anus-stomach-esophagus', 1, 0),
	(169, 51, 'mouth-anus-stomach', 1, 0),
	(170, 51, 'mouth-lungs-stomach', 1, 0),
	(171, 52, 'bladder- nephrone-glomerolus', 1, 0),
	(172, 52, 'nephlone to the glumerulus', 1, 0),
	(173, 52, 'filtration-re absorption-secretion', 1, 1),
	(174, 52, 'filtration-glumerulus', 1, 0);
/*!40000 ALTER TABLE `policy_answers` ENABLE KEYS */;

-- Dumping structure for table myteached_db.policy_codes
CREATE TABLE IF NOT EXISTS `policy_codes` (
  `Policy_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Code` text DEFAULT NULL,
  `Email` text DEFAULT NULL,
  `Status` int(11) DEFAULT 1,
  `Staff_Id` int(11) DEFAULT NULL,
  `Subject_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Policy_Id`),
  KEY `Staff_Id` (`Staff_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.policy_codes: ~6 rows (approximately)
/*!40000 ALTER TABLE `policy_codes` DISABLE KEYS */;
INSERT INTO `policy_codes` (`Policy_Id`, `Code`, `Email`, `Status`, `Staff_Id`, `Subject_Id`) VALUES
	(39, '96NrKX9C', 'workhardbeforewintercomes@gmail.com', 1, 96, 2),
	(40, '93CNMbtf', 'naturindapatrickkosa@gmail.com', 1, 93, 4),
	(41, '95G7TkLn', 'workhardbeforewintercomes@gmail.com', 0, 95, 2),
	(42, '101RVrh6Z', 'workhardbeforewintercomes@gmail.com', 0, 101, 5),
	(43, '102hNtxnV', 'naturindapatrickkosa@gmail.com', 0, 102, 5),
	(44, '1036CFVjz', 'itprogrammer.bwindihospital@gmail.com', 1, 103, 5);
/*!40000 ALTER TABLE `policy_codes` ENABLE KEYS */;

-- Dumping structure for table myteached_db.policy_questions
CREATE TABLE IF NOT EXISTS `policy_questions` (
  `Question_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text DEFAULT NULL,
  `Marks` int(11) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Choice` int(11) DEFAULT 1,
  `Subject_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Question_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.policy_questions: ~10 rows (approximately)
/*!40000 ALTER TABLE `policy_questions` DISABLE KEYS */;
INSERT INTO `policy_questions` (`Question_Id`, `Question`, `Marks`, `Status`, `Choice`, `Subject_Id`) VALUES
	(43, 'nutrition quetion 1', 2, 1, 1, 2),
	(44, 'nutrition quetion 2', 5, 1, 2, 2),
	(45, 'dgdgsdgdddb', 1, 1, 2, 1),
	(46, 'Anatomy question 1 for set6', 3, 1, 2, 4),
	(47, 'testing', 5, 1, 2, 2),
	(48, 'what part of a cell controls all the functions of other cell organells ', 2, 1, 1, 5),
	(49, 'what is the name given to the power house of the cell ', 2, 1, 1, 5),
	(50, 'what name is given to the food substance after swallowing during digestion', 2, 1, 1, 5),
	(51, 'what is the order of digestion of food from the mouth to the stomach', 2, 1, 1, 5),
	(52, 'The following is the best order of urine formation ', 2, 1, 1, 5);
/*!40000 ALTER TABLE `policy_questions` ENABLE KEYS */;

-- Dumping structure for view myteached_db.question_performance
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `question_performance` (
	`Staff_Id` INT(11) NULL,
	`Question_Id` INT(11) NULL,
	`Subject_Id` INT(11) NULL,
	`Correct_answer` BIGINT(21) NOT NULL,
	`Marks` INT(11) NULL,
	`Performance` BIGINT(31) NULL
) ENGINE=MyISAM;

-- Dumping structure for table myteached_db.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `Staff_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Status` int(11) NOT NULL DEFAULT 1,
  `Code` tinytext DEFAULT NULL,
  `Time_submittes` datetime NOT NULL DEFAULT current_timestamp(),
  `Image` text DEFAULT NULL,
  `Staff_Name` varchar(50) DEFAULT NULL,
  `Class_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Staff_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.staff: ~62 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` (`Staff_Id`, `Status`, `Code`, `Time_submittes`, `Image`, `Staff_Name`, `Class_Id`) VALUES
	(42, 1, '489', '2019-07-24 13:01:02', '', 'NATURINDA PATRICK', NULL),
	(43, 1, '487', '2019-07-24 14:40:18', '', 'ATUKUNDA DOREEN', NULL),
	(44, 1, '489', '2019-07-30 09:35:49', '', 'OFUMBA YABIN', NULL),
	(45, 1, '485', '2019-07-30 09:56:04', '', 'ARINEITWE EMMANUEL', NULL),
	(46, 1, '454', '2019-07-30 11:42:36', '', 'KYASIIMIRE EVALYNE', NULL),
	(47, 1, '358', '2019-07-31 08:47:19', 'Valence.jpg', 'MUTABAZI VARENCE', NULL),
	(48, 1, '449', '2019-07-31 08:51:16', 'Charles1.jpg', 'TUMWIJUKYE CHARLES', NULL),
	(49, 1, '307', '2019-08-03 12:26:58', 'Allan.jpg', 'ATUSINGUZA ALLAN', NULL),
	(50, 1, '500', '2019-08-07 11:36:05', 'mh1(1).jpg', 'BWETE DAMYANO Z', NULL),
	(51, 1, '494', '2019-08-12 18:38:55', 'Preston.jpg', 'ORIMWESIGA PRESTON', NULL),
	(52, 1, '495', '2019-08-12 18:40:18', 'Jackie.jpg', 'MANENO JACKLINE', NULL),
	(53, 1, '496', '2019-08-12 18:41:27', 'Ju.jpg', 'TUKUNDANE JUSTUS', NULL),
	(54, 1, '497', '2019-08-12 18:42:18', 'PHIONAH.jpg', 'AYEBARE PHIONAH', NULL),
	(55, 1, '498', '2019-08-12 18:43:20', 'dan.jpg', 'MUTABAZI DANIEL', NULL),
	(56, 1, '499', '2019-08-12 18:44:03', 'Namara Michael(1).jpg', 'NAMARA MICHAEL', NULL),
	(57, 1, '501', '2019-08-12 18:46:04', 'Costance.jpg', 'NITUSIIMA COSTANCE', NULL),
	(58, 1, '329', '2019-08-13 08:53:41', 'Rona.jpg', 'AKATUHIRIRA RONNAH', NULL),
	(59, 1, '493', '2019-08-13 16:08:56', '', 'TUKAMUSHABA RUTH', NULL),
	(60, 1, '490', '2019-08-16 16:14:20', '', 'NIWAGABA RONALD', NULL),
	(61, 1, '491', '2019-08-26 11:17:09', '', 'EDSON  NIYONZIMA', NULL),
	(62, 1, '1', '2019-09-06 11:05:17', '', 'BIRUNGI EDWIN', NULL),
	(63, 1, '386', '2019-09-06 11:09:15', '', 'REV. ELIZABETH AKANDINDA', NULL),
	(64, 1, '352', '2019-09-06 11:18:25', 'Barnabas 2.jpg', 'OYESIGA BARNABAS', NULL),
	(65, 1, '92', '2019-09-06 11:20:16', '', 'KWIKIRIZA STUART', NULL),
	(66, 1, '0', '2019-09-06 12:21:50', '', 'MUREZI MERETH', NULL),
	(67, 1, '325', '2019-09-06 12:25:52', '', 'TWONGYEIRWE ENOCK B', NULL),
	(68, 1, '306', '2019-09-06 12:28:54', '', 'WALUGEMBE EDWARD', NULL),
	(69, 1, '482', '2019-09-06 12:33:57', '', 'TURYATUNGA BOAZ', NULL),
	(70, 1, '483', '2019-09-06 12:46:37', '', 'KAMUGISHA ROBERT', NULL),
	(71, 1, '263', '2019-09-06 14:51:11', '', 'KUULE YUSUFU', NULL),
	(72, 1, '191', '2019-09-06 14:52:59', 'Harriet.jpg', 'KABASOMI HARRIET', NULL),
	(73, 1, '413', '2019-09-06 14:57:31', '', 'KURIGAMBA GIDEON K', NULL),
	(74, 1, '504', '2019-09-25 08:57:40', 'Name ID.jpg', 'MUTAMWEBWA GORETH', NULL),
	(75, 1, '493', '2019-09-25 09:00:19', 'Ruth 2.jpg', 'TUKAMUSHABA RUTH', NULL),
	(76, 1, '503', '2019-09-25 09:01:26', 'holly.jpg', 'HOLLY TYSON', NULL),
	(77, 1, '505', '2019-10-11 17:09:36', 'Dr Ben.jpg', 'BEN OCHOLA', NULL),
	(78, 1, '506', '2019-10-11 17:10:55', 'Dr Elias.jpg', 'BYAMUKAMA ELIAS', NULL),
	(79, 1, '466', '2019-10-11 17:13:16', 'Kule.jpg', 'KULE ATHOLERE GAMALYERI', NULL),
	(80, 1, '68', '2019-10-11 17:41:46', 'Mukwatanise.jpg', 'MUKWATANISE DENNIS', NULL),
	(81, 0, '468', '2019-10-19 12:36:44', '', 'TESTING TESTING', NULL),
	(82, 1, '502', '2019-10-23 12:36:09', 'DR IVAN E.jpg', 'WALUFU IVAN EGESA', NULL),
	(83, 1, '503', '2019-10-24 09:26:24', 'Capture.PNG', 'MARGARET REEVES', NULL),
	(84, 1, '504', '2019-11-22 09:32:38', '', 'MARIAN', NULL),
	(85, 1, '505', '2019-11-25 13:07:22', 'Stella.jpg', 'AKANCUNGURA STELLA', NULL),
	(86, 1, '508', '2019-12-12 15:29:27', 'Basolime.jpg', 'BASOLENE YONA', NULL),
	(87, 1, '509', '2019-12-12 15:31:52', 'Ziporah.jpg', 'AKANSASIRA ZIPORAH', NULL),
	(88, 1, '510', '2019-12-12 15:33:59', 'Patrica.jpg', 'ORIKIRIZA PATRICIA', NULL),
	(89, 1, '448', '2019-12-12 15:39:23', 'Jastus.jpg', 'TUSIIME JUSTUS', NULL),
	(90, 1, '511', '2020-01-11 15:56:34', 'Anita.jpg', 'AMPEIRE ANITA', NULL),
	(91, 1, '512', '2020-01-11 15:58:26', 'James.jpg', 'AHEMIGISHA JAMES', NULL),
	(92, 1, '513', '2020-01-11 16:00:29', 'Kennedy.jpg', 'AHIMBISIBWE KENEDY', 3),
	(93, 1, '514', '2020-01-11 16:01:37', 'Elizabeth.jpg', 'ARIHO ELIZABETH', 2),
	(94, 1, '515', '2020-01-11 16:03:08', 'Grace.jpg', 'NAHURIRA GRACE', 3),
	(95, 1, '184', '2020-01-20 14:29:40', 'Onesmus.jpg', 'NIWAGABA ONESMUS', 1),
	(96, 1, '185', '2020-02-08 15:26:24', '', 'DR.KATE', 1),
	(97, 1, '186', '2020-05-23 10:35:51', 'patrick.jpg', 'ANDREW', 4),
	(98, 1, '187', '2020-05-23 15:59:30', '', 'AGIREMBABAZI ANASTORIO', 2),
	(99, 1, '188', '2020-05-23 16:01:41', '', 'TUMUKUNDE AGUSTINE', 1),
	(100, 1, '189', '2020-05-23 16:05:10', '', 'AKANTORANA JACOB', 3),
	(101, 1, 'CM1920', '2020-05-25 17:18:47', '', 'DALLEN', 5),
	(102, 1, 'CN1920', '2020-05-25 17:36:33', '', 'DEUS', 5),
	(103, 1, '1', '2020-05-25 17:51:34', '', 'NATURINDA PATRICK KOSA', 5);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table myteached_db.staff_answer
CREATE TABLE IF NOT EXISTS `staff_answer` (
  `Staff_Answer_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_Id` int(11) DEFAULT NULL,
  `Question_Id` int(11) DEFAULT NULL,
  `Answer_Id` int(11) DEFAULT NULL,
  `Subject_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Staff_Answer_Id`),
  KEY `Staff_Id` (`Staff_Id`),
  KEY `Question_Id` (`Question_Id`),
  KEY `Answer_Id` (`Answer_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.staff_answer: ~20 rows (approximately)
/*!40000 ALTER TABLE `staff_answer` DISABLE KEYS */;
INSERT INTO `staff_answer` (`Staff_Answer_Id`, `Staff_Id`, `Question_Id`, `Answer_Id`, `Subject_Id`) VALUES
	(21, 93, 46, 148, 4),
	(23, 93, 46, 149, 4),
	(24, 96, 43, 142, 2),
	(27, 96, 47, 151, 2),
	(28, 96, 47, 153, 2),
	(29, 96, 44, 147, 2),
	(41, 95, 43, 143, 2),
	(42, 95, 44, 146, 2),
	(43, 95, 47, 153, 2),
	(44, 95, 47, 154, 2),
	(45, 101, 48, 156, 5),
	(46, 101, 49, 160, 5),
	(47, 101, 50, 163, 5),
	(48, 101, 51, 167, 5),
	(49, 101, 52, 172, 5),
	(50, 102, 48, 158, 5),
	(51, 102, 49, 160, 5),
	(52, 102, 50, 165, 5),
	(53, 102, 51, 170, 5),
	(54, 102, 52, 173, 5);
/*!40000 ALTER TABLE `staff_answer` ENABLE KEYS */;

-- Dumping structure for view myteached_db.staff_performance
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `staff_performance` (
	`Staff_Id` INT(11) NULL,
	`Subject_Id` INT(11) NULL,
	`Staff_Name` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`Staff_Performance` DECIMAL(52,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for table myteached_db.subject
CREATE TABLE IF NOT EXISTS `subject` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject_Name` varchar(100) DEFAULT NULL,
  `Class_Id` int(11) DEFAULT NULL,
  `Status` int(11) DEFAULT 1,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.subject: ~5 rows (approximately)
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` (`Id`, `Subject_Name`, `Class_Id`, `Status`) VALUES
	(1, 'anatomy', 1, 1),
	(2, 'nutrition', 1, 1),
	(3, 'fgfgf', 2, 0),
	(4, 'anatomy', 2, 1),
	(5, 'Antomy', 5, 1);
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;

-- Dumping structure for table myteached_db.system_email
CREATE TABLE IF NOT EXISTS `system_email` (
  `Email_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` text DEFAULT NULL,
  `Password` text DEFAULT NULL,
  `Status` int(11) DEFAULT 1,
  `Type` varchar(50) DEFAULT 'Survey',
  PRIMARY KEY (`Email_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table myteached_db.system_email: ~1 rows (approximately)
/*!40000 ALTER TABLE `system_email` DISABLE KEYS */;
INSERT INTO `system_email` (`Email_Id`, `Email`, `Password`, `Status`, `Type`) VALUES
	(2, 'naturindapatrickkosa@gmail.com', 'successor', 1, 'Policy');
/*!40000 ALTER TABLE `system_email` ENABLE KEYS */;

-- Dumping structure for view myteached_db.total_correct_answer
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `total_correct_answer` (
	`Question_Id` INT(11) NOT NULL,
	`Subject_Id` INT(11) NULL,
	`Marks` INT(11) NULL,
	`Correct_Answers` BIGINT(21) NOT NULL,
	`Total_Marks` BIGINT(31) NULL
) ENGINE=MyISAM;

-- Dumping structure for view myteached_db.question_performance
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `question_performance`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `question_performance` AS select staff_answer.Staff_Id,staff_answer.Question_Id, staff_answer.Subject_Id,count(staff_answer.Answer_Id) as Correct_answer,policy_questions.Marks as Marks,(count(staff_answer.Answer_Id)*policy_questions.Marks) as Performance from staff,policy_questions,policy_answers,staff_answer where staff_answer.Subject_Id=policy_questions.Subject_Id and staff_answer.Staff_Id=staff.Staff_Id and staff_answer.Answer_Id=policy_answers.Answer_Id
 and staff_answer.Question_Id=policy_questions.Question_Id and staff_answer.Question_Id=policy_answers.Question_Id and policy_answers.Correct=1 group by staff_answer.Question_Id,staff.Staff_Id ;

-- Dumping structure for view myteached_db.staff_performance
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `staff_performance`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `staff_performance` AS select question_performance.Staff_Id,question_performance.Subject_Id,staff.Staff_Name,sum(question_performance.Performance) as Staff_Performance from staff,question_performance where question_performance.Staff_Id=staff.Staff_Id group by question_performance.Subject_Id,question_performance.Staff_Id ;

-- Dumping structure for view myteached_db.total_correct_answer
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `total_correct_answer`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `total_correct_answer` AS select policy_questions.Question_Id,policy_questions.Subject_Id,policy_questions.Marks as Marks,count(policy_answers.Answer_Id) as Correct_Answers,(count(policy_answers.Answer_Id)*policy_questions.Marks) as Total_Marks from policy_questions,policy_answers where 
 policy_questions.Question_Id=policy_answers.Question_Id and policy_answers.Correct=1 group by policy_answers.Question_Id ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
