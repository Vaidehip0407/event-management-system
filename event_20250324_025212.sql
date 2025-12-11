DROP TABLE IF EXISTS admin_master;

CREATE TABLE `admin_master` (
  `admin_id` int NOT NULL,
  `admin_name` text COLLATE utf8mb4_general_ci,
  `admin_password` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO admin_master VALUES("1","admin","admin");
INSERT INTO admin_master VALUES("1","admin","admin");
INSERT INTO admin_master VALUES("1","admin","admin");



DROP TABLE IF EXISTS competitions;

CREATE TABLE `competitions` (
  `com_id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `first_prize` varchar(255) DEFAULT NULL,
  `second_prize` varchar(255) DEFAULT NULL,
  `event_fees` decimal(10,2) DEFAULT '0.00',
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`com_id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("1","1","Coding Challenge","A competitive coding contest. Solve algorithmic problems under pressure.","2024-07-20","13:00:00","Laptop","Tablet","25.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("2","1","Robotics Competition","Teams design and build robots to complete challenges.","2024-07-21","10:00:00","3D Printer","Robotics Kit","50.00","1","2025-03-14 12:25:36");
INSERT INTO competitions VALUES("3","1","Mobile App Design","Design the best mobile app for a specific user need.","2024-07-20","15:00:00","Software License","Online Course Voucher","15.00","1","2025-03-14 12:25:36");



DROP TABLE IF EXISTS contact;

CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO contact VALUES("1","Vaidehi panchal","1","xyz","xyz","2025-02-08 21:20:30");
INSERT INTO contact VALUES("2","Daksh Panchal","dax@gamil.com","for event","amazing event","2025-02-26 19:04:12");
INSERT INTO contact VALUES("1","Vaidehi panchal","1","xyz","xyz","2025-02-08 21:20:30");
INSERT INTO contact VALUES("2","Daksh Panchal","dax@gamil.com","for event","amazing event","2025-02-26 19:04:12");
INSERT INTO contact VALUES("1","Vaidehi panchal","1","xyz","xyz","2025-02-08 21:20:30");
INSERT INTO contact VALUES("2","Daksh Panchal","dax@gamil.com","for event","amazing event","2025-02-26 19:04:12");
INSERT INTO contact VALUES("1","Vaidehi panchal","1","xyz","xyz","2025-02-08 21:20:30");
INSERT INTO contact VALUES("2","Daksh Panchal","dax@gamil.com","for event","amazing event","2025-02-26 19:04:12");
INSERT INTO contact VALUES("1","Vaidehi panchal","1","xyz","xyz","2025-02-08 21:20:30");
INSERT INTO contact VALUES("2","Daksh Panchal","dax@gamil.com","for event","amazing event","2025-02-26 19:04:12");
INSERT INTO contact VALUES("1","Vaidehi panchal","1","xyz","xyz","2025-02-08 21:20:30");
INSERT INTO contact VALUES("2","Daksh Panchal","dax@gamil.com","for event","amazing event","2025-02-26 19:04:12");



DROP TABLE IF EXISTS event_master;

CREATE TABLE `event_master` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_name` text COLLATE utf8mb4_general_ci,
  `event_description` text COLLATE utf8mb4_general_ci,
  `event_date` text COLLATE utf8mb4_general_ci,
  `event_location` text COLLATE utf8mb4_general_ci,
  `event_time` text COLLATE utf8mb4_general_ci,
  `f_prize` text COLLATE utf8mb4_general_ci NOT NULL,
  `s_prize` text COLLATE utf8mb4_general_ci NOT NULL,
  `event_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `max_par` int DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("52","Young Developer"," Mobile /Website application development event.","2025-03-27","MKICS","10:00","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("53"," Crack the Code","Error Identification or output prediction from the C++ / JAVA / Python/ C code. Students may choose any one programming language. Offline-mode event. Time duration: 1 hour.","2025-03-27","MKICS","12:45","Trophy, Certificate","Certificate","100.00","0","1");
INSERT INTO event_master VALUES("54","Algorithm Design & Implementation Contest"," Focuses on algorithmic thinking. Participants design and implement efficient algorithms to solve complex computational problems. Often judged on correctness, efficiency (time and space complexity), and code clarity.\\r\\n","2025-03-27","MKICS","11:00","Trophy, Certificate","Certificate","200.00","0","1");
INSERT INTO event_master VALUES("55","Web Development Fundamentals Workshop","A beginner-friendly workshop covering the basics of HTML, CSS, and JavaScript. Participants will build a simple webpage by the end of the session. Bring your laptop!","2025-03-27","Computer Lab-1","","Trophy, Certificate","Certificate","100.00","30","1");
INSERT INTO event_master VALUES("56","Guest Lecture - \\\"Future of Artificial Intelligence\\\"","A seminar featuring Dr. Eleanor Vance, a leading expert in Artificial Intelligence, discussing the latest trends, ethical considerations, and future possibilities of AI. Open to all interested students and faculty.","2025-03-28","Auditorium","14:00","-","-","0.00","0","1");
INSERT INTO event_master VALUES("57","Algorithmic Ace Coding Competition","A competitive programming contest testing algorithmic problem-solving skills. Participants will solve challenging problems in a timed environment.","2025-03-31","Computer Labs 1 & 2","10:00","Gaming Laptop + Certificate","High-End Graphics Card + Certificate","10.00","0","1");
INSERT INTO event_master VALUES("58","Ethical Hacking Fundamentals Workshop","An introductory workshop to the world of cybersecurity and ethical hacking. Learn basic penetration testing techniques and network security concepts.","2025-04-01","Seminar Hall","14:00","Cybersecurity Book Collection + Course Voucher","Raspberry Pi Kit + Cybersecurity Toolkit","5.00","0","1");
INSERT INTO event_master VALUES("59","Seminar: The Future of AI","A seminar exploring the latest advancements and ethical implications of Artificial Intelligence and Machine Learning. Featuring guest speakers from the industry.","2025-01-15","Auditorium","11:00","N/A","N/A","0.00","0","1");
INSERT INTO event_master VALUES("60","Game Jam 24-Hour Hackathon","A 24-hour game development competition where teams create games from scratch based on a theme announced at the start.","2025-02-05","College Hall & Computer Labs","14:00","VR Headset for each team member + Software Licenses","Graphics Tablets for each team member + Game Assets Pack","8.00","0","1");
INSERT INTO event_master VALUES("61","React.js for Beginners Workshop","A hands-on workshop teaching the fundamentals of React.js, a popular JavaScript library for building user interfaces.","2025-03-20","Online - Zoom Platform","15:00","React.js Course + Web Hosting Voucher","React.js Book + Online Learning Subscription","3.00","0","1");
INSERT INTO event_master VALUES("62","Data Insights Discovery Bootcamp","An intensive bootcamp covering data analysis, visualization, and basic machine learning techniques for extracting insights from data.","2025-04-12","Classrooms 3 & 4","09:00","Data Science Internship + Professional Certification Voucher","Data Analysis Software License + Data Science Book Set","15.00","0","1");
INSERT INTO event_master VALUES("63","Intro to Flutter App Development Session"," A session introducing Flutter, Google\\\'s UI toolkit for building natively compiled applications for mobile, web, and desktop from a single codebase.","2025-04-28","Online - Google Meet","16:00","N/A","N/A","0.00","0","1");



DROP TABLE IF EXISTS event_registrations;

CREATE TABLE `event_registrations` (
  `registration_id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contact_number` varchar(20) DEFAULT NULL,
  `dietary_restrictions` varchar(255) DEFAULT NULL,
  `other_info` text,
  PRIMARY KEY (`registration_id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `event_registrations_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event_master` (`event_id`),
  CONSTRAINT `event_registrations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




DROP TABLE IF EXISTS event_results;

CREATE TABLE `event_results` (
  `result_id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `result_data` text,
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `first_place_college` varchar(255) DEFAULT NULL,
  `first_place_student` varchar(255) DEFAULT NULL,
  `second_place_college` varchar(255) DEFAULT NULL,
  `second_place_student` varchar(255) DEFAULT NULL,
  `third_place_college` varchar(255) DEFAULT NULL,
  `third_place_student` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`result_id`),
  KEY `event_id` (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");
INSERT INTO event_results VALUES("1","30"," Run Time","","2025-03-06 19:05:24","mkics","abcd","mkics","xyz","mkics","pqr","0");
INSERT INTO event_results VALUES("2","31"," Run Time","","2025-03-12 09:54:48","PPSU","Prachi","SDJ-Surat","Krupangi","MKICS","Vaidehi","1");
INSERT INTO event_results VALUES("3","33"," Crack the Code","","2025-03-12 10:00:12","MKICS","Esha","C.B.Patel-Surat","Vaidehi","MSU","Darshit","1");



DROP TABLE IF EXISTS event_schedule;

CREATE TABLE `event_schedule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO event_schedule VALUES("52","Seminar: The Future of AI","11:00","Auditorium","2025-01-15");
INSERT INTO event_schedule VALUES("53","Game Jam 24-Hour Hackathon","14:00","College Hall & Computer Labs","2025-02-05");
INSERT INTO event_schedule VALUES("54","React.js for Beginners Workshop","15:00","Online - Zoom Platform","2025-03-20");
INSERT INTO event_schedule VALUES("55","Young Developer","10:00","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("56","Crack the Code","12:45","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("57","Algorithm Design & Implementation Contest","11:00","MKICS","2025-05-27");
INSERT INTO event_schedule VALUES("58","Web Development Fundamentals Workshop","10:00","Computer Lab-1","2025-03-27");
INSERT INTO event_schedule VALUES("59","Guest Lecture - \\\\\\\"Future of Artificial Intelligence\\\\\\\""," 14:00","Auditorium","2025-03-28");
INSERT INTO event_schedule VALUES("60","Algorithmic Ace Coding Competition","10:00","Computer Labs 1 & 2","2025-03-31");
INSERT INTO event_schedule VALUES("61","Ethical Hacking Fundamentals Workshop","14:00","Seminar Hall","2025-04-01");
INSERT INTO event_schedule VALUES("62"," Data Insights Discovery Bootcamp","09:00","Classrooms 3 & 4","2025-04-12");
INSERT INTO event_schedule VALUES("63","Intro to Flutter App Development Session","16:00","Online - Google Meet","2025-04-28");
INSERT INTO event_schedule VALUES("52","Seminar: The Future of AI","11:00","Auditorium","2025-01-15");
INSERT INTO event_schedule VALUES("53","Game Jam 24-Hour Hackathon","14:00","College Hall & Computer Labs","2025-02-05");
INSERT INTO event_schedule VALUES("54","React.js for Beginners Workshop","15:00","Online - Zoom Platform","2025-03-20");
INSERT INTO event_schedule VALUES("55","Young Developer","10:00","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("56","Crack the Code","12:45","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("57","Algorithm Design & Implementation Contest","11:00","MKICS","2025-05-27");
INSERT INTO event_schedule VALUES("58","Web Development Fundamentals Workshop","10:00","Computer Lab-1","2025-03-27");
INSERT INTO event_schedule VALUES("59","Guest Lecture - \\\\\\\"Future of Artificial Intelligence\\\\\\\""," 14:00","Auditorium","2025-03-28");
INSERT INTO event_schedule VALUES("60","Algorithmic Ace Coding Competition","10:00","Computer Labs 1 & 2","2025-03-31");
INSERT INTO event_schedule VALUES("61","Ethical Hacking Fundamentals Workshop","14:00","Seminar Hall","2025-04-01");
INSERT INTO event_schedule VALUES("62"," Data Insights Discovery Bootcamp","09:00","Classrooms 3 & 4","2025-04-12");
INSERT INTO event_schedule VALUES("63","Intro to Flutter App Development Session","16:00","Online - Google Meet","2025-04-28");
INSERT INTO event_schedule VALUES("52","Seminar: The Future of AI","11:00","Auditorium","2025-01-15");
INSERT INTO event_schedule VALUES("53","Game Jam 24-Hour Hackathon","14:00","College Hall & Computer Labs","2025-02-05");
INSERT INTO event_schedule VALUES("54","React.js for Beginners Workshop","15:00","Online - Zoom Platform","2025-03-20");
INSERT INTO event_schedule VALUES("55","Young Developer","10:00","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("56","Crack the Code","12:45","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("57","Algorithm Design & Implementation Contest","11:00","MKICS","2025-05-27");
INSERT INTO event_schedule VALUES("58","Web Development Fundamentals Workshop","10:00","Computer Lab-1","2025-03-27");
INSERT INTO event_schedule VALUES("59","Guest Lecture - \\\\\\\"Future of Artificial Intelligence\\\\\\\""," 14:00","Auditorium","2025-03-28");
INSERT INTO event_schedule VALUES("60","Algorithmic Ace Coding Competition","10:00","Computer Labs 1 & 2","2025-03-31");
INSERT INTO event_schedule VALUES("61","Ethical Hacking Fundamentals Workshop","14:00","Seminar Hall","2025-04-01");
INSERT INTO event_schedule VALUES("62"," Data Insights Discovery Bootcamp","09:00","Classrooms 3 & 4","2025-04-12");
INSERT INTO event_schedule VALUES("63","Intro to Flutter App Development Session","16:00","Online - Google Meet","2025-04-28");
INSERT INTO event_schedule VALUES("52","Seminar: The Future of AI","11:00","Auditorium","2025-01-15");
INSERT INTO event_schedule VALUES("53","Game Jam 24-Hour Hackathon","14:00","College Hall & Computer Labs","2025-02-05");
INSERT INTO event_schedule VALUES("54","React.js for Beginners Workshop","15:00","Online - Zoom Platform","2025-03-20");
INSERT INTO event_schedule VALUES("55","Young Developer","10:00","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("56","Crack the Code","12:45","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("57","Algorithm Design & Implementation Contest","11:00","MKICS","2025-05-27");
INSERT INTO event_schedule VALUES("58","Web Development Fundamentals Workshop","10:00","Computer Lab-1","2025-03-27");
INSERT INTO event_schedule VALUES("59","Guest Lecture - \\\\\\\"Future of Artificial Intelligence\\\\\\\""," 14:00","Auditorium","2025-03-28");
INSERT INTO event_schedule VALUES("60","Algorithmic Ace Coding Competition","10:00","Computer Labs 1 & 2","2025-03-31");
INSERT INTO event_schedule VALUES("61","Ethical Hacking Fundamentals Workshop","14:00","Seminar Hall","2025-04-01");
INSERT INTO event_schedule VALUES("62"," Data Insights Discovery Bootcamp","09:00","Classrooms 3 & 4","2025-04-12");
INSERT INTO event_schedule VALUES("63","Intro to Flutter App Development Session","16:00","Online - Google Meet","2025-04-28");
INSERT INTO event_schedule VALUES("52","Seminar: The Future of AI","11:00","Auditorium","2025-01-15");
INSERT INTO event_schedule VALUES("53","Game Jam 24-Hour Hackathon","14:00","College Hall & Computer Labs","2025-02-05");
INSERT INTO event_schedule VALUES("54","React.js for Beginners Workshop","15:00","Online - Zoom Platform","2025-03-20");
INSERT INTO event_schedule VALUES("55","Young Developer","10:00","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("56","Crack the Code","12:45","MKICS","2025-03-27");
INSERT INTO event_schedule VALUES("57","Algorithm Design & Implementation Contest","11:00","MKICS","2025-05-27");
INSERT INTO event_schedule VALUES("58","Web Development Fundamentals Workshop","10:00","Computer Lab-1","2025-03-27");
INSERT INTO event_schedule VALUES("59","Guest Lecture - \\\\\\\"Future of Artificial Intelligence\\\\\\\""," 14:00","Auditorium","2025-03-28");
INSERT INTO event_schedule VALUES("60","Algorithmic Ace Coding Competition","10:00","Computer Labs 1 & 2","2025-03-31");
INSERT INTO event_schedule VALUES("61","Ethical Hacking Fundamentals Workshop","14:00","Seminar Hall","2025-04-01");
INSERT INTO event_schedule VALUES("62"," Data Insights Discovery Bootcamp","09:00","Classrooms 3 & 4","2025-04-12");
INSERT INTO event_schedule VALUES("63","Intro to Flutter App Development Session","16:00","Online - Google Meet","2025-04-28");



DROP TABLE IF EXISTS events;

CREATE TABLE `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `short_description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO events VALUES("1","Summer Tech Festival","2024-07-20 10:00:00","City Convention Center","A celebration of technology with workshops, competitions, and keynote speakers.","2025-03-14 12:25:23","1");
INSERT INTO events VALUES("1","Summer Tech Festival","2024-07-20 10:00:00","City Convention Center","A celebration of technology with workshops, competitions, and keynote speakers.","2025-03-14 12:25:23","1");
INSERT INTO events VALUES("1","Summer Tech Festival","2024-07-20 10:00:00","City Convention Center","A celebration of technology with workshops, competitions, and keynote speakers.","2025-03-14 12:25:23","1");
INSERT INTO events VALUES("1","Summer Tech Festival","2024-07-20 10:00:00","City Convention Center","A celebration of technology with workshops, competitions, and keynote speakers.","2025-03-14 12:25:23","1");
INSERT INTO events VALUES("1","Summer Tech Festival","2024-07-20 10:00:00","City Convention Center","A celebration of technology with workshops, competitions, and keynote speakers.","2025-03-14 12:25:23","1");
INSERT INTO events VALUES("1","Summer Tech Festival","2024-07-20 10:00:00","City Convention Center","A celebration of technology with workshops, competitions, and keynote speakers.","2025-03-14 12:25:23","1");
INSERT INTO events VALUES("1","Summer Tech Festival","2024-07-20 10:00:00","City Convention Center","A celebration of technology with workshops, competitions, and keynote speakers.","2025-03-14 12:25:23","1");



DROP TABLE IF EXISTS feedback_website;

CREATE TABLE `feedback_website` (
  `f_id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci,
  `feedback_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `rating` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO feedback_website VALUES("19","0","mkics","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("20","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("21","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:17:07");
INSERT INTO feedback_website VALUES("22","52","nice","jay@gmail.com","0","5","2025-02-26 20:43:34");
INSERT INTO feedback_website VALUES("23","57","nice","palak@gmail.com","0","5","2025-03-06 09:25:21");
INSERT INTO feedback_website VALUES("24","56","hiii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:28:20");
INSERT INTO feedback_website VALUES("25","56","hii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:29:43");
INSERT INTO feedback_website VALUES("19","0","mkics","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("20","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("21","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:17:07");
INSERT INTO feedback_website VALUES("22","52","nice","jay@gmail.com","0","5","2025-02-26 20:43:34");
INSERT INTO feedback_website VALUES("23","57","nice","palak@gmail.com","0","5","2025-03-06 09:25:21");
INSERT INTO feedback_website VALUES("24","56","hiii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:28:20");
INSERT INTO feedback_website VALUES("25","56","hii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:29:43");
INSERT INTO feedback_website VALUES("19","0","mkics","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("20","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("21","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:17:07");
INSERT INTO feedback_website VALUES("22","52","nice","jay@gmail.com","0","5","2025-02-26 20:43:34");
INSERT INTO feedback_website VALUES("23","57","nice","palak@gmail.com","0","5","2025-03-06 09:25:21");
INSERT INTO feedback_website VALUES("24","56","hiii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:28:20");
INSERT INTO feedback_website VALUES("25","56","hii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:29:43");
INSERT INTO feedback_website VALUES("19","0","mkics","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("20","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("21","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:17:07");
INSERT INTO feedback_website VALUES("22","52","nice","jay@gmail.com","0","5","2025-02-26 20:43:34");
INSERT INTO feedback_website VALUES("23","57","nice","palak@gmail.com","0","5","2025-03-06 09:25:21");
INSERT INTO feedback_website VALUES("24","56","hiii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:28:20");
INSERT INTO feedback_website VALUES("25","56","hii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:29:43");
INSERT INTO feedback_website VALUES("19","0","mkics","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("20","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("21","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:17:07");
INSERT INTO feedback_website VALUES("22","52","nice","jay@gmail.com","0","5","2025-02-26 20:43:34");
INSERT INTO feedback_website VALUES("23","57","nice","palak@gmail.com","0","5","2025-03-06 09:25:21");
INSERT INTO feedback_website VALUES("24","56","hiii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:28:20");
INSERT INTO feedback_website VALUES("25","56","hii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:29:43");
INSERT INTO feedback_website VALUES("19","0","mkics","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("20","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("21","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:17:07");
INSERT INTO feedback_website VALUES("22","52","nice","jay@gmail.com","0","5","2025-02-26 20:43:34");
INSERT INTO feedback_website VALUES("23","57","nice","palak@gmail.com","0","5","2025-03-06 09:25:21");
INSERT INTO feedback_website VALUES("24","56","hiii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:28:20");
INSERT INTO feedback_website VALUES("25","56","hii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:29:43");
INSERT INTO feedback_website VALUES("19","0","mkics","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("20","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:05:38");
INSERT INTO feedback_website VALUES("21","0","hii,hello","vaidehipanchal3@gmail.com","0","5","2025-02-26 16:17:07");
INSERT INTO feedback_website VALUES("22","52","nice","jay@gmail.com","0","5","2025-02-26 20:43:34");
INSERT INTO feedback_website VALUES("23","57","nice","palak@gmail.com","0","5","2025-03-06 09:25:21");
INSERT INTO feedback_website VALUES("24","56","hiii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:28:20");
INSERT INTO feedback_website VALUES("25","56","hii","vaidehipanchal3@gmail.com","0","5","2025-03-06 09:29:43");



DROP TABLE IF EXISTS gallery_images;

CREATE TABLE `gallery_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `year` int NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO gallery_images VALUES("2","2024","uploads/IMG_4089.JPG","");
INSERT INTO gallery_images VALUES("3","2024","uploads/IMG_4090.JPG","");
INSERT INTO gallery_images VALUES("4","2024","uploads/IMG_4091.JPG","");
INSERT INTO gallery_images VALUES("7","2024","uploads/IMG_4169.JPG","");
INSERT INTO gallery_images VALUES("8","2024","uploads/IMG_4482.JPG","");
INSERT INTO gallery_images VALUES("9","2024","uploads/IMG_4213.JPG","");
INSERT INTO gallery_images VALUES("10","2024","uploads/IMG_4482.JPG","");
INSERT INTO gallery_images VALUES("11","2024","uploads/IMG_4212.JPG","");
INSERT INTO gallery_images VALUES("2","2024","uploads/IMG_4089.JPG","");
INSERT INTO gallery_images VALUES("3","2024","uploads/IMG_4090.JPG","");
INSERT INTO gallery_images VALUES("4","2024","uploads/IMG_4091.JPG","");
INSERT INTO gallery_images VALUES("7","2024","uploads/IMG_4169.JPG","");
INSERT INTO gallery_images VALUES("8","2024","uploads/IMG_4482.JPG","");
INSERT INTO gallery_images VALUES("9","2024","uploads/IMG_4213.JPG","");
INSERT INTO gallery_images VALUES("10","2024","uploads/IMG_4482.JPG","");
INSERT INTO gallery_images VALUES("11","2024","uploads/IMG_4212.JPG","");
INSERT INTO gallery_images VALUES("2","2024","uploads/IMG_4089.JPG","");
INSERT INTO gallery_images VALUES("3","2024","uploads/IMG_4090.JPG","");
INSERT INTO gallery_images VALUES("4","2024","uploads/IMG_4091.JPG","");
INSERT INTO gallery_images VALUES("7","2024","uploads/IMG_4169.JPG","");
INSERT INTO gallery_images VALUES("8","2024","uploads/IMG_4482.JPG","");
INSERT INTO gallery_images VALUES("9","2024","uploads/IMG_4213.JPG","");
INSERT INTO gallery_images VALUES("10","2024","uploads/IMG_4482.JPG","");
INSERT INTO gallery_images VALUES("11","2024","uploads/IMG_4212.JPG","");
INSERT INTO gallery_images VALUES("2","2024","uploads/IMG_4089.JPG","");
INSERT INTO gallery_images VALUES("3","2024","uploads/IMG_4090.JPG","");
INSERT INTO gallery_images VALUES("4","2024","uploads/IMG_4091.JPG","");
INSERT INTO gallery_images VALUES("7","2024","uploads/IMG_4169.JPG","");
INSERT INTO gallery_images VALUES("8","2024","uploads/IMG_4482.JPG","");
INSERT INTO gallery_images VALUES("9","2024","uploads/IMG_4213.JPG","");
INSERT INTO gallery_images VALUES("10","2024","uploads/IMG_4482.JPG","");
INSERT INTO gallery_images VALUES("11","2024","uploads/IMG_4212.JPG","");



DROP TABLE IF EXISTS participate_master;

CREATE TABLE `participate_master` (
  `participation_id` int NOT NULL AUTO_INCREMENT,
  `event_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `participation_status` text COLLATE utf8mb4_general_ci,
  `p_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`participation_id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO participate_master VALUES("44","11","35","Accepted","vaidehi panchal","0");
INSERT INTO participate_master VALUES("48","11","35","Accepted","prachi","0");
INSERT INTO participate_master VALUES("51","11","35","Accepted","daksh panchal","0");
INSERT INTO participate_master VALUES("52","11","35","Accepted","nilam panchal","0");
INSERT INTO participate_master VALUES("53","11","35","Accepted","abcd","0");
INSERT INTO participate_master VALUES("56","22","40","Accepted","harsh parmar","0");
INSERT INTO participate_master VALUES("57","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("58","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("61","24","43","Accepted","abcd","0");
INSERT INTO participate_master VALUES("44","11","35","Accepted","vaidehi panchal","0");
INSERT INTO participate_master VALUES("48","11","35","Accepted","prachi","0");
INSERT INTO participate_master VALUES("51","11","35","Accepted","daksh panchal","0");
INSERT INTO participate_master VALUES("52","11","35","Accepted","nilam panchal","0");
INSERT INTO participate_master VALUES("53","11","35","Accepted","abcd","0");
INSERT INTO participate_master VALUES("56","22","40","Accepted","harsh parmar","0");
INSERT INTO participate_master VALUES("57","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("58","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("61","24","43","Accepted","abcd","0");
INSERT INTO participate_master VALUES("44","11","35","Accepted","vaidehi panchal","0");
INSERT INTO participate_master VALUES("48","11","35","Accepted","prachi","0");
INSERT INTO participate_master VALUES("51","11","35","Accepted","daksh panchal","0");
INSERT INTO participate_master VALUES("52","11","35","Accepted","nilam panchal","0");
INSERT INTO participate_master VALUES("53","11","35","Accepted","abcd","0");
INSERT INTO participate_master VALUES("56","22","40","Accepted","harsh parmar","0");
INSERT INTO participate_master VALUES("57","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("58","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("61","24","43","Accepted","abcd","0");
INSERT INTO participate_master VALUES("44","11","35","Accepted","vaidehi panchal","0");
INSERT INTO participate_master VALUES("48","11","35","Accepted","prachi","0");
INSERT INTO participate_master VALUES("51","11","35","Accepted","daksh panchal","0");
INSERT INTO participate_master VALUES("52","11","35","Accepted","nilam panchal","0");
INSERT INTO participate_master VALUES("53","11","35","Accepted","abcd","0");
INSERT INTO participate_master VALUES("56","22","40","Accepted","harsh parmar","0");
INSERT INTO participate_master VALUES("57","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("58","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("61","24","43","Accepted","abcd","0");
INSERT INTO participate_master VALUES("44","11","35","Accepted","vaidehi panchal","0");
INSERT INTO participate_master VALUES("48","11","35","Accepted","prachi","0");
INSERT INTO participate_master VALUES("51","11","35","Accepted","daksh panchal","0");
INSERT INTO participate_master VALUES("52","11","35","Accepted","nilam panchal","0");
INSERT INTO participate_master VALUES("53","11","35","Accepted","abcd","0");
INSERT INTO participate_master VALUES("56","22","40","Accepted","harsh parmar","0");
INSERT INTO participate_master VALUES("57","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("58","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("61","24","43","Accepted","abcd","0");
INSERT INTO participate_master VALUES("44","11","35","Accepted","vaidehi panchal","0");
INSERT INTO participate_master VALUES("48","11","35","Accepted","prachi","0");
INSERT INTO participate_master VALUES("51","11","35","Accepted","daksh panchal","0");
INSERT INTO participate_master VALUES("52","11","35","Accepted","nilam panchal","0");
INSERT INTO participate_master VALUES("53","11","35","Accepted","abcd","0");
INSERT INTO participate_master VALUES("56","22","40","Accepted","harsh parmar","0");
INSERT INTO participate_master VALUES("57","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("58","22","42","Accepted","jenil k panchal","0");
INSERT INTO participate_master VALUES("61","24","43","Accepted","abcd","0");



DROP TABLE IF EXISTS password_reset;

CREATE TABLE `password_reset` (
  `reset_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry_time` datetime NOT NULL,
  PRIMARY KEY (`reset_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO password_reset VALUES("1","56","797328","2025-03-05 12:36:36");
INSERT INTO password_reset VALUES("2","56","959725","2025-03-05 12:39:06");
INSERT INTO password_reset VALUES("3","56","235644","2025-03-05 12:40:49");
INSERT INTO password_reset VALUES("4","56","114531","2025-03-05 12:42:02");
INSERT INTO password_reset VALUES("5","56","254154","2025-03-07 12:50:28");
INSERT INTO password_reset VALUES("6","56","124193","2025-03-07 12:53:53");
INSERT INTO password_reset VALUES("7","56","530636","2025-03-07 12:56:30");
INSERT INTO password_reset VALUES("8","56","903781","2025-03-07 12:57:49");
INSERT INTO password_reset VALUES("9","56","477590","2025-03-07 12:58:35");
INSERT INTO password_reset VALUES("10","56","174845","2025-03-07 13:05:07");
INSERT INTO password_reset VALUES("11","56","238112","2025-03-07 13:05:49");
INSERT INTO password_reset VALUES("23","58","922385","2025-03-11 09:27:19");
INSERT INTO password_reset VALUES("22","58","335645","2025-03-11 09:26:12");
INSERT INTO password_reset VALUES("21","58","152958","2025-03-11 09:22:57");
INSERT INTO password_reset VALUES("20","58","928319","2025-03-11 09:22:08");
INSERT INTO password_reset VALUES("19","58","218510","2025-03-10 16:19:44");
INSERT INTO password_reset VALUES("18","58","197640","2025-03-07 13:48:01");
INSERT INTO password_reset VALUES("24","58","939196","2025-03-11 09:30:20");
INSERT INTO password_reset VALUES("25","58","544430","2025-03-11 09:30:24");
INSERT INTO password_reset VALUES("26","58","636194","2025-03-11 16:21:15");
INSERT INTO password_reset VALUES("27","58","590302","2025-03-11 16:21:58");
INSERT INTO password_reset VALUES("28","58","910954","2025-03-11 16:23:37");
INSERT INTO password_reset VALUES("29","58","711793","2025-03-11 16:25:30");
INSERT INTO password_reset VALUES("30","58","157067","2025-03-11 16:28:36");
INSERT INTO password_reset VALUES("31","58","856082","2025-03-11 16:30:38");
INSERT INTO password_reset VALUES("32","58","334145","2025-03-11 16:32:07");
INSERT INTO password_reset VALUES("33","58","250143","2025-03-11 16:36:09");
INSERT INTO password_reset VALUES("34","62","240601","2025-03-11 16:54:40");
INSERT INTO password_reset VALUES("35","62","156752","2025-03-11 16:54:45");
INSERT INTO password_reset VALUES("36","62","610900","2025-03-11 17:29:44");
INSERT INTO password_reset VALUES("37","58","786182","2025-03-12 05:39:57");
INSERT INTO password_reset VALUES("38","58","348878","2025-03-12 05:45:22");
INSERT INTO password_reset VALUES("39","58","400593","2025-03-20 05:56:19");
INSERT INTO password_reset VALUES("1","56","797328","2025-03-05 12:36:36");
INSERT INTO password_reset VALUES("2","56","959725","2025-03-05 12:39:06");
INSERT INTO password_reset VALUES("3","56","235644","2025-03-05 12:40:49");
INSERT INTO password_reset VALUES("4","56","114531","2025-03-05 12:42:02");
INSERT INTO password_reset VALUES("5","56","254154","2025-03-07 12:50:28");
INSERT INTO password_reset VALUES("6","56","124193","2025-03-07 12:53:53");
INSERT INTO password_reset VALUES("7","56","530636","2025-03-07 12:56:30");
INSERT INTO password_reset VALUES("8","56","903781","2025-03-07 12:57:49");
INSERT INTO password_reset VALUES("9","56","477590","2025-03-07 12:58:35");
INSERT INTO password_reset VALUES("10","56","174845","2025-03-07 13:05:07");
INSERT INTO password_reset VALUES("11","56","238112","2025-03-07 13:05:49");
INSERT INTO password_reset VALUES("23","58","922385","2025-03-11 09:27:19");
INSERT INTO password_reset VALUES("22","58","335645","2025-03-11 09:26:12");
INSERT INTO password_reset VALUES("21","58","152958","2025-03-11 09:22:57");
INSERT INTO password_reset VALUES("20","58","928319","2025-03-11 09:22:08");
INSERT INTO password_reset VALUES("19","58","218510","2025-03-10 16:19:44");
INSERT INTO password_reset VALUES("18","58","197640","2025-03-07 13:48:01");
INSERT INTO password_reset VALUES("24","58","939196","2025-03-11 09:30:20");
INSERT INTO password_reset VALUES("25","58","544430","2025-03-11 09:30:24");
INSERT INTO password_reset VALUES("26","58","636194","2025-03-11 16:21:15");
INSERT INTO password_reset VALUES("27","58","590302","2025-03-11 16:21:58");
INSERT INTO password_reset VALUES("28","58","910954","2025-03-11 16:23:37");
INSERT INTO password_reset VALUES("29","58","711793","2025-03-11 16:25:30");
INSERT INTO password_reset VALUES("30","58","157067","2025-03-11 16:28:36");
INSERT INTO password_reset VALUES("31","58","856082","2025-03-11 16:30:38");
INSERT INTO password_reset VALUES("32","58","334145","2025-03-11 16:32:07");
INSERT INTO password_reset VALUES("33","58","250143","2025-03-11 16:36:09");
INSERT INTO password_reset VALUES("34","62","240601","2025-03-11 16:54:40");
INSERT INTO password_reset VALUES("35","62","156752","2025-03-11 16:54:45");
INSERT INTO password_reset VALUES("36","62","610900","2025-03-11 17:29:44");
INSERT INTO password_reset VALUES("37","58","786182","2025-03-12 05:39:57");
INSERT INTO password_reset VALUES("38","58","348878","2025-03-12 05:45:22");
INSERT INTO password_reset VALUES("39","58","400593","2025-03-20 05:56:19");
INSERT INTO password_reset VALUES("1","56","797328","2025-03-05 12:36:36");
INSERT INTO password_reset VALUES("2","56","959725","2025-03-05 12:39:06");
INSERT INTO password_reset VALUES("3","56","235644","2025-03-05 12:40:49");
INSERT INTO password_reset VALUES("4","56","114531","2025-03-05 12:42:02");
INSERT INTO password_reset VALUES("5","56","254154","2025-03-07 12:50:28");
INSERT INTO password_reset VALUES("6","56","124193","2025-03-07 12:53:53");
INSERT INTO password_reset VALUES("7","56","530636","2025-03-07 12:56:30");
INSERT INTO password_reset VALUES("8","56","903781","2025-03-07 12:57:49");
INSERT INTO password_reset VALUES("9","56","477590","2025-03-07 12:58:35");
INSERT INTO password_reset VALUES("10","56","174845","2025-03-07 13:05:07");
INSERT INTO password_reset VALUES("11","56","238112","2025-03-07 13:05:49");
INSERT INTO password_reset VALUES("23","58","922385","2025-03-11 09:27:19");
INSERT INTO password_reset VALUES("22","58","335645","2025-03-11 09:26:12");
INSERT INTO password_reset VALUES("21","58","152958","2025-03-11 09:22:57");
INSERT INTO password_reset VALUES("20","58","928319","2025-03-11 09:22:08");
INSERT INTO password_reset VALUES("19","58","218510","2025-03-10 16:19:44");
INSERT INTO password_reset VALUES("18","58","197640","2025-03-07 13:48:01");
INSERT INTO password_reset VALUES("24","58","939196","2025-03-11 09:30:20");
INSERT INTO password_reset VALUES("25","58","544430","2025-03-11 09:30:24");
INSERT INTO password_reset VALUES("26","58","636194","2025-03-11 16:21:15");
INSERT INTO password_reset VALUES("27","58","590302","2025-03-11 16:21:58");
INSERT INTO password_reset VALUES("28","58","910954","2025-03-11 16:23:37");
INSERT INTO password_reset VALUES("29","58","711793","2025-03-11 16:25:30");
INSERT INTO password_reset VALUES("30","58","157067","2025-03-11 16:28:36");
INSERT INTO password_reset VALUES("31","58","856082","2025-03-11 16:30:38");
INSERT INTO password_reset VALUES("32","58","334145","2025-03-11 16:32:07");
INSERT INTO password_reset VALUES("33","58","250143","2025-03-11 16:36:09");
INSERT INTO password_reset VALUES("34","62","240601","2025-03-11 16:54:40");
INSERT INTO password_reset VALUES("35","62","156752","2025-03-11 16:54:45");
INSERT INTO password_reset VALUES("36","62","610900","2025-03-11 17:29:44");
INSERT INTO password_reset VALUES("37","58","786182","2025-03-12 05:39:57");
INSERT INTO password_reset VALUES("38","58","348878","2025-03-12 05:45:22");
INSERT INTO password_reset VALUES("39","58","400593","2025-03-20 05:56:19");
INSERT INTO password_reset VALUES("1","56","797328","2025-03-05 12:36:36");
INSERT INTO password_reset VALUES("2","56","959725","2025-03-05 12:39:06");
INSERT INTO password_reset VALUES("3","56","235644","2025-03-05 12:40:49");
INSERT INTO password_reset VALUES("4","56","114531","2025-03-05 12:42:02");
INSERT INTO password_reset VALUES("5","56","254154","2025-03-07 12:50:28");
INSERT INTO password_reset VALUES("6","56","124193","2025-03-07 12:53:53");
INSERT INTO password_reset VALUES("7","56","530636","2025-03-07 12:56:30");
INSERT INTO password_reset VALUES("8","56","903781","2025-03-07 12:57:49");
INSERT INTO password_reset VALUES("9","56","477590","2025-03-07 12:58:35");
INSERT INTO password_reset VALUES("10","56","174845","2025-03-07 13:05:07");
INSERT INTO password_reset VALUES("11","56","238112","2025-03-07 13:05:49");
INSERT INTO password_reset VALUES("23","58","922385","2025-03-11 09:27:19");
INSERT INTO password_reset VALUES("22","58","335645","2025-03-11 09:26:12");
INSERT INTO password_reset VALUES("21","58","152958","2025-03-11 09:22:57");
INSERT INTO password_reset VALUES("20","58","928319","2025-03-11 09:22:08");
INSERT INTO password_reset VALUES("19","58","218510","2025-03-10 16:19:44");
INSERT INTO password_reset VALUES("18","58","197640","2025-03-07 13:48:01");
INSERT INTO password_reset VALUES("24","58","939196","2025-03-11 09:30:20");
INSERT INTO password_reset VALUES("25","58","544430","2025-03-11 09:30:24");
INSERT INTO password_reset VALUES("26","58","636194","2025-03-11 16:21:15");
INSERT INTO password_reset VALUES("27","58","590302","2025-03-11 16:21:58");
INSERT INTO password_reset VALUES("28","58","910954","2025-03-11 16:23:37");
INSERT INTO password_reset VALUES("29","58","711793","2025-03-11 16:25:30");
INSERT INTO password_reset VALUES("30","58","157067","2025-03-11 16:28:36");
INSERT INTO password_reset VALUES("31","58","856082","2025-03-11 16:30:38");
INSERT INTO password_reset VALUES("32","58","334145","2025-03-11 16:32:07");
INSERT INTO password_reset VALUES("33","58","250143","2025-03-11 16:36:09");
INSERT INTO password_reset VALUES("34","62","240601","2025-03-11 16:54:40");
INSERT INTO password_reset VALUES("35","62","156752","2025-03-11 16:54:45");
INSERT INTO password_reset VALUES("36","62","610900","2025-03-11 17:29:44");
INSERT INTO password_reset VALUES("37","58","786182","2025-03-12 05:39:57");
INSERT INTO password_reset VALUES("38","58","348878","2025-03-12 05:45:22");
INSERT INTO password_reset VALUES("39","58","400593","2025-03-20 05:56:19");



DROP TABLE IF EXISTS payments;

CREATE TABLE `payments` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `event_id` int NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `event_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `registration_id` int DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `registration_id` (`registration_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");
INSERT INTO payments VALUES("6","58","33","100.00","2025-03-09 14:09:34","success","TXN-67cd53c696eec2.38440780"," Crack the Code","vaidehi@gmail.com","6");
INSERT INTO payments VALUES("7","59","33","100.00","2025-03-09 15:03:16","success","TXN-67cd605c88c269.36841876"," Crack the Code","Khushiahir@gmail.com","7");
INSERT INTO payments VALUES("12","58","31","100.00","2025-03-12 09:50:14","success","TXN-67d10b7e8535d0.21839113","Quick Magic","vaidehipanchal3@gmail.com","12");
INSERT INTO payments VALUES("8","59","37","100.00","2025-03-09 15:07:27","success","TXN-67cd615745ac90.50317286","Rangoli competition","Khushiahir@gmail.com","8");
INSERT INTO payments VALUES("9","59","34","100.00","2025-03-09 15:10:29","success","TXN-67cd620d118121.54531047"," Quizzical ","Khushiahir@gmail.com","9");
INSERT INTO payments VALUES("11","60","31","100.00","2025-03-11 21:14:04","success","TXN-67d05a4446ee20.64262330","Quick Magic","krupangi@gmail.com","11");
INSERT INTO payments VALUES("13","58","34","100.00","2025-03-12 10:31:52","success","TXN-67d11540ca0924.54425300"," Quizzical ","vaidehipanchal3@gmail.com","13");
INSERT INTO payments VALUES("14","58","48","100.00","2025-03-13 08:59:11","success","TXN-67d25107bbb523.86464033","Quizzical ","Khushiahir@gmail.com","14");
INSERT INTO payments VALUES("15","58","51","100.00","2025-03-14 14:12:25","success","TXN-67d3ebf1566394.89230655"," Crack the Code","vaidehipanchal3@gmail.com","15");
INSERT INTO payments VALUES("21","63","61","3.00","2025-03-19 11:17:12","success","TXN-67da5a608448b3.33865884","React.js for Beginners Workshop","darshitmodi@gmail.com","21");
INSERT INTO payments VALUES("17","58","53","100.00","2025-03-14 14:53:50","success","TXN-67d3f5a6e581f2.97652540"," Crack the Code","vaidehipanchal3@gmail.com","17");
INSERT INTO payments VALUES("18","58","59","0.00","2025-03-18 09:58:45","success","TXN-67d8f67da4ffd2.27238218","Seminar: The Future of AI","vaidehipanchal3@gmail.com","18");
INSERT INTO payments VALUES("19","58","56","0.00","2025-03-18 10:01:07","success","TXN-67d8f70ba5ce53.35029272","Guest Lecture - \"Future of Artificial Intelligence\"","Khushiahir@gmail.com","19");
INSERT INTO payments VALUES("20","60","57","10.00","2025-03-19 11:13:27","success","TXN-67da597f577cb0.90727270","Algorithmic Ace Coding Competition","krupangi@gmail.com","20");
INSERT INTO payments VALUES("22","63","59","0.00","2025-03-19 11:32:41","success","TXN-67da5e01e3f763.85671519","Seminar: The Future of AI","darshitmodi@gmail.com","23");



DROP TABLE IF EXISTS registrations;

CREATE TABLE `registrations` (
  `registration_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `com_id` int NOT NULL,
  `registration_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`registration_id`),
  KEY `user_id` (`user_id`),
  KEY `com_id` (`com_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO registrations VALUES("1","58","2","2025-03-14 13:22:54");
INSERT INTO registrations VALUES("1","58","2","2025-03-14 13:22:54");
INSERT INTO registrations VALUES("1","58","2","2025-03-14 13:22:54");
INSERT INTO registrations VALUES("1","58","2","2025-03-14 13:22:54");



DROP TABLE IF EXISTS rules_regulations;

CREATE TABLE `rules_regulations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `display_order` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO rules_regulations VALUES("9"," Young Developer","This event challenges participants to develop innovative mobile or website applications based on a topic of their choice. The application must be an original work created by the participant(s). Any programming language, development framework, or software tool is permitted. Participants are required to bring their application to the competition for presentation. The application should be functional and demonstrable during the event, and participants are responsible for ensuring its readiness for a seamless demo. Participants must bring their own device for presentation and be prepared to make on-the-spot modifications if requested during the competition. The event is open to all students, with a maximum team size of two students per team. Judgment will be based on presentation quality, innovative idea, project understanding, and future usefulness.","0");
INSERT INTO rules_regulations VALUES("10","Quick Magic","This is an individual event open to all First Year (FY) students. Participants will have one hour to complete the C programming challenge.","0");
INSERT INTO rules_regulations VALUES("11","Run-time","This event is open to Second Year (SY) and Third Year (TY) students, with a team size of two members. Participants are encouraged to utilize data visualization tools such as Pandas, NumPy, and Matplotlib. Teams will have one hour to complete the Python-SQLite challenge.","0");
INSERT INTO rules_regulations VALUES("12"," Crack the Code","In this individual event, participants will analyze code snippets in C++, JAVA, Python, or C to identify errors or predict the output. Participants may choose any one programming language for the challenge. This is an offline event with a time duration of one hour, and it is open to all students.","0");
INSERT INTO rules_regulations VALUES("9"," Young Developer","This event challenges participants to develop innovative mobile or website applications based on a topic of their choice. The application must be an original work created by the participant(s). Any programming language, development framework, or software tool is permitted. Participants are required to bring their application to the competition for presentation. The application should be functional and demonstrable during the event, and participants are responsible for ensuring its readiness for a seamless demo. Participants must bring their own device for presentation and be prepared to make on-the-spot modifications if requested during the competition. The event is open to all students, with a maximum team size of two students per team. Judgment will be based on presentation quality, innovative idea, project understanding, and future usefulness.","0");
INSERT INTO rules_regulations VALUES("10","Quick Magic","This is an individual event open to all First Year (FY) students. Participants will have one hour to complete the C programming challenge.","0");
INSERT INTO rules_regulations VALUES("11","Run-time","This event is open to Second Year (SY) and Third Year (TY) students, with a team size of two members. Participants are encouraged to utilize data visualization tools such as Pandas, NumPy, and Matplotlib. Teams will have one hour to complete the Python-SQLite challenge.","0");
INSERT INTO rules_regulations VALUES("12"," Crack the Code","In this individual event, participants will analyze code snippets in C++, JAVA, Python, or C to identify errors or predict the output. Participants may choose any one programming language for the challenge. This is an offline event with a time duration of one hour, and it is open to all students.","0");
INSERT INTO rules_regulations VALUES("9"," Young Developer","This event challenges participants to develop innovative mobile or website applications based on a topic of their choice. The application must be an original work created by the participant(s). Any programming language, development framework, or software tool is permitted. Participants are required to bring their application to the competition for presentation. The application should be functional and demonstrable during the event, and participants are responsible for ensuring its readiness for a seamless demo. Participants must bring their own device for presentation and be prepared to make on-the-spot modifications if requested during the competition. The event is open to all students, with a maximum team size of two students per team. Judgment will be based on presentation quality, innovative idea, project understanding, and future usefulness.","0");
INSERT INTO rules_regulations VALUES("10","Quick Magic","This is an individual event open to all First Year (FY) students. Participants will have one hour to complete the C programming challenge.","0");
INSERT INTO rules_regulations VALUES("11","Run-time","This event is open to Second Year (SY) and Third Year (TY) students, with a team size of two members. Participants are encouraged to utilize data visualization tools such as Pandas, NumPy, and Matplotlib. Teams will have one hour to complete the Python-SQLite challenge.","0");
INSERT INTO rules_regulations VALUES("12"," Crack the Code","In this individual event, participants will analyze code snippets in C++, JAVA, Python, or C to identify errors or predict the output. Participants may choose any one programming language for the challenge. This is an offline event with a time duration of one hour, and it is open to all students.","0");
INSERT INTO rules_regulations VALUES("9"," Young Developer","This event challenges participants to develop innovative mobile or website applications based on a topic of their choice. The application must be an original work created by the participant(s). Any programming language, development framework, or software tool is permitted. Participants are required to bring their application to the competition for presentation. The application should be functional and demonstrable during the event, and participants are responsible for ensuring its readiness for a seamless demo. Participants must bring their own device for presentation and be prepared to make on-the-spot modifications if requested during the competition. The event is open to all students, with a maximum team size of two students per team. Judgment will be based on presentation quality, innovative idea, project understanding, and future usefulness.","0");
INSERT INTO rules_regulations VALUES("10","Quick Magic","This is an individual event open to all First Year (FY) students. Participants will have one hour to complete the C programming challenge.","0");
INSERT INTO rules_regulations VALUES("11","Run-time","This event is open to Second Year (SY) and Third Year (TY) students, with a team size of two members. Participants are encouraged to utilize data visualization tools such as Pandas, NumPy, and Matplotlib. Teams will have one hour to complete the Python-SQLite challenge.","0");
INSERT INTO rules_regulations VALUES("12"," Crack the Code","In this individual event, participants will analyze code snippets in C++, JAVA, Python, or C to identify errors or predict the output. Participants may choose any one programming language for the challenge. This is an offline event with a time duration of one hour, and it is open to all students.","0");



DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `setting_name` varchar(255) NOT NULL,
  `setting_value` text,
  `setting_description` text,
  `data_type` varchar(50) DEFAULT 'string',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_setting` (`category`,`setting_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO settings VALUES("1","Event","default_event_duration","3","Default duration of events in hours","integer");
INSERT INTO settings VALUES("2","Event","event_registration_open","1","Allow users to register for events","boolean");
INSERT INTO settings VALUES("3","Feedback","feedback_enabled","0","Allow users to submit feedback for events","boolean");
INSERT INTO settings VALUES("4","General","website_name","College Event Management System","The name of this website","string");
INSERT INTO settings VALUES("5","Registration","early_bird_discount_percent","10","Percentage discount for early registrations","integer");
INSERT INTO settings VALUES("6","Registration","max_participants","100","Maximum number of participants allowed per event","integer");
INSERT INTO settings VALUES("7","Security","password_reset_limit","3","Maximum number of times a user can reset their password within 24 hours","integer");
INSERT INTO settings VALUES("8","Social","social_sharing_enabled","1","Display sharing buttons for social media on event pages","boolean");
INSERT INTO settings VALUES("1","Event","default_event_duration","3","Default duration of events in hours","integer");
INSERT INTO settings VALUES("2","Event","event_registration_open","1","Allow users to register for events","boolean");
INSERT INTO settings VALUES("3","Feedback","feedback_enabled","0","Allow users to submit feedback for events","boolean");
INSERT INTO settings VALUES("4","General","website_name","College Event Management System","The name of this website","string");
INSERT INTO settings VALUES("5","Registration","early_bird_discount_percent","10","Percentage discount for early registrations","integer");
INSERT INTO settings VALUES("6","Registration","max_participants","100","Maximum number of participants allowed per event","integer");
INSERT INTO settings VALUES("7","Security","password_reset_limit","3","Maximum number of times a user can reset their password within 24 hours","integer");
INSERT INTO settings VALUES("8","Social","social_sharing_enabled","1","Display sharing buttons for social media on event pages","boolean");
INSERT INTO settings VALUES("1","Event","default_event_duration","3","Default duration of events in hours","integer");
INSERT INTO settings VALUES("2","Event","event_registration_open","1","Allow users to register for events","boolean");
INSERT INTO settings VALUES("3","Feedback","feedback_enabled","0","Allow users to submit feedback for events","boolean");
INSERT INTO settings VALUES("4","General","website_name","College Event Management System","The name of this website","string");
INSERT INTO settings VALUES("5","Registration","early_bird_discount_percent","10","Percentage discount for early registrations","integer");
INSERT INTO settings VALUES("6","Registration","max_participants","100","Maximum number of participants allowed per event","integer");
INSERT INTO settings VALUES("7","Security","password_reset_limit","3","Maximum number of times a user can reset their password within 24 hours","integer");
INSERT INTO settings VALUES("8","Social","social_sharing_enabled","1","Display sharing buttons for social media on event pages","boolean");
INSERT INTO settings VALUES("1","Event","default_event_duration","3","Default duration of events in hours","integer");
INSERT INTO settings VALUES("2","Event","event_registration_open","1","Allow users to register for events","boolean");
INSERT INTO settings VALUES("3","Feedback","feedback_enabled","0","Allow users to submit feedback for events","boolean");
INSERT INTO settings VALUES("4","General","website_name","College Event Management System","The name of this website","string");
INSERT INTO settings VALUES("5","Registration","early_bird_discount_percent","10","Percentage discount for early registrations","integer");
INSERT INTO settings VALUES("6","Registration","max_participants","100","Maximum number of participants allowed per event","integer");
INSERT INTO settings VALUES("7","Security","password_reset_limit","3","Maximum number of times a user can reset their password within 24 hours","integer");
INSERT INTO settings VALUES("8","Social","social_sharing_enabled","1","Display sharing buttons for social media on event pages","boolean");
INSERT INTO settings VALUES("1","Event","default_event_duration","3","Default duration of events in hours","integer");
INSERT INTO settings VALUES("2","Event","event_registration_open","1","Allow users to register for events","boolean");
INSERT INTO settings VALUES("3","Feedback","feedback_enabled","0","Allow users to submit feedback for events","boolean");
INSERT INTO settings VALUES("4","General","website_name","College Event Management System","The name of this website","string");
INSERT INTO settings VALUES("5","Registration","early_bird_discount_percent","10","Percentage discount for early registrations","integer");
INSERT INTO settings VALUES("6","Registration","max_participants","100","Maximum number of participants allowed per event","integer");
INSERT INTO settings VALUES("7","Security","password_reset_limit","3","Maximum number of times a user can reset their password within 24 hours","integer");
INSERT INTO settings VALUES("8","Social","social_sharing_enabled","1","Display sharing buttons for social media on event pages","boolean");
INSERT INTO settings VALUES("1","Event","default_event_duration","3","Default duration of events in hours","integer");
INSERT INTO settings VALUES("2","Event","event_registration_open","1","Allow users to register for events","boolean");
INSERT INTO settings VALUES("3","Feedback","feedback_enabled","0","Allow users to submit feedback for events","boolean");
INSERT INTO settings VALUES("4","General","website_name","College Event Management System","The name of this website","string");
INSERT INTO settings VALUES("5","Registration","early_bird_discount_percent","10","Percentage discount for early registrations","integer");
INSERT INTO settings VALUES("6","Registration","max_participants","100","Maximum number of participants allowed per event","integer");
INSERT INTO settings VALUES("7","Security","password_reset_limit","3","Maximum number of times a user can reset their password within 24 hours","integer");
INSERT INTO settings VALUES("8","Social","social_sharing_enabled","1","Display sharing buttons for social media on event pages","boolean");



DROP TABLE IF EXISTS user_event_registration;

CREATE TABLE `user_event_registration` (
  `registration_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `event_id` int NOT NULL,
  `registration_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `classno` varchar(255) NOT NULL,
  `rollno` varchar(255) NOT NULL,
  PRIMARY KEY (`registration_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO user_event_registration VALUES("23","63","59","2025-03-19 11:32:41","success","4","109");
INSERT INTO user_event_registration VALUES("22","63","59","2025-03-19 11:31:55","success","4","109");
INSERT INTO user_event_registration VALUES("16","58","52","2025-03-14 14:53:10","success","1","101");
INSERT INTO user_event_registration VALUES("17","58","53","2025-03-14 14:53:50","success","1","101");
INSERT INTO user_event_registration VALUES("18","58","59","2025-03-18 09:58:45","success","5","102");
INSERT INTO user_event_registration VALUES("19","58","56","2025-03-18 10:01:07","success","3","105");
INSERT INTO user_event_registration VALUES("20","60","57","2025-03-19 11:13:27","success","5","22001");
INSERT INTO user_event_registration VALUES("21","63","61","2025-03-19 11:17:12","success","2","109");
INSERT INTO user_event_registration VALUES("23","63","59","2025-03-19 11:32:41","success","4","109");
INSERT INTO user_event_registration VALUES("22","63","59","2025-03-19 11:31:55","success","4","109");
INSERT INTO user_event_registration VALUES("16","58","52","2025-03-14 14:53:10","success","1","101");
INSERT INTO user_event_registration VALUES("17","58","53","2025-03-14 14:53:50","success","1","101");
INSERT INTO user_event_registration VALUES("18","58","59","2025-03-18 09:58:45","success","5","102");
INSERT INTO user_event_registration VALUES("19","58","56","2025-03-18 10:01:07","success","3","105");
INSERT INTO user_event_registration VALUES("20","60","57","2025-03-19 11:13:27","success","5","22001");
INSERT INTO user_event_registration VALUES("21","63","61","2025-03-19 11:17:12","success","2","109");
INSERT INTO user_event_registration VALUES("23","63","59","2025-03-19 11:32:41","success","4","109");
INSERT INTO user_event_registration VALUES("22","63","59","2025-03-19 11:31:55","success","4","109");
INSERT INTO user_event_registration VALUES("16","58","52","2025-03-14 14:53:10","success","1","101");
INSERT INTO user_event_registration VALUES("17","58","53","2025-03-14 14:53:50","success","1","101");
INSERT INTO user_event_registration VALUES("18","58","59","2025-03-18 09:58:45","success","5","102");
INSERT INTO user_event_registration VALUES("19","58","56","2025-03-18 10:01:07","success","3","105");
INSERT INTO user_event_registration VALUES("20","60","57","2025-03-19 11:13:27","success","5","22001");
INSERT INTO user_event_registration VALUES("21","63","61","2025-03-19 11:17:12","success","2","109");
INSERT INTO user_event_registration VALUES("23","63","59","2025-03-19 11:32:41","success","4","109");
INSERT INTO user_event_registration VALUES("22","63","59","2025-03-19 11:31:55","success","4","109");
INSERT INTO user_event_registration VALUES("16","58","52","2025-03-14 14:53:10","success","1","101");
INSERT INTO user_event_registration VALUES("17","58","53","2025-03-14 14:53:50","success","1","101");
INSERT INTO user_event_registration VALUES("18","58","59","2025-03-18 09:58:45","success","5","102");
INSERT INTO user_event_registration VALUES("19","58","56","2025-03-18 10:01:07","success","3","105");
INSERT INTO user_event_registration VALUES("20","60","57","2025-03-19 11:13:27","success","5","22001");
INSERT INTO user_event_registration VALUES("21","63","61","2025-03-19 11:17:12","success","2","109");
INSERT INTO user_event_registration VALUES("23","63","59","2025-03-19 11:32:41","success","4","109");
INSERT INTO user_event_registration VALUES("22","63","59","2025-03-19 11:31:55","success","4","109");
INSERT INTO user_event_registration VALUES("16","58","52","2025-03-14 14:53:10","success","1","101");
INSERT INTO user_event_registration VALUES("17","58","53","2025-03-14 14:53:50","success","1","101");
INSERT INTO user_event_registration VALUES("18","58","59","2025-03-18 09:58:45","success","5","102");
INSERT INTO user_event_registration VALUES("19","58","56","2025-03-18 10:01:07","success","3","105");
INSERT INTO user_event_registration VALUES("20","60","57","2025-03-19 11:13:27","success","5","22001");
INSERT INTO user_event_registration VALUES("21","63","61","2025-03-19 11:17:12","success","2","109");
INSERT INTO user_event_registration VALUES("23","63","59","2025-03-19 11:32:41","success","4","109");
INSERT INTO user_event_registration VALUES("22","63","59","2025-03-19 11:31:55","success","4","109");
INSERT INTO user_event_registration VALUES("16","58","52","2025-03-14 14:53:10","success","1","101");
INSERT INTO user_event_registration VALUES("17","58","53","2025-03-14 14:53:50","success","1","101");
INSERT INTO user_event_registration VALUES("18","58","59","2025-03-18 09:58:45","success","5","102");
INSERT INTO user_event_registration VALUES("19","58","56","2025-03-18 10:01:07","success","3","105");
INSERT INTO user_event_registration VALUES("20","60","57","2025-03-19 11:13:27","success","5","22001");
INSERT INTO user_event_registration VALUES("21","63","61","2025-03-19 11:17:12","success","2","109");
INSERT INTO user_event_registration VALUES("23","63","59","2025-03-19 11:32:41","success","4","109");
INSERT INTO user_event_registration VALUES("22","63","59","2025-03-19 11:31:55","success","4","109");
INSERT INTO user_event_registration VALUES("16","58","52","2025-03-14 14:53:10","success","1","101");
INSERT INTO user_event_registration VALUES("17","58","53","2025-03-14 14:53:50","success","1","101");
INSERT INTO user_event_registration VALUES("18","58","59","2025-03-18 09:58:45","success","5","102");
INSERT INTO user_event_registration VALUES("19","58","56","2025-03-18 10:01:07","success","3","105");
INSERT INTO user_event_registration VALUES("20","60","57","2025-03-19 11:13:27","success","5","22001");
INSERT INTO user_event_registration VALUES("21","63","61","2025-03-19 11:17:12","success","2","109");



DROP TABLE IF EXISTS user_master;

CREATE TABLE `user_master` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` text COLLATE utf8mb4_general_ci,
  `user_email` text COLLATE utf8mb4_general_ci,
  `user_password` text COLLATE utf8mb4_general_ci,
  `user_address` text COLLATE utf8mb4_general_ci,
  `otp` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `otp_expiry` int DEFAULT NULL,
  `user_created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO user_master VALUES("51","Dax Panchal","dax@gamil.com","$2y$10$4mBTIw3cfVekxwCocaLGv.sm62MK9GgddVNCzTRPCLvCg5JxAT8Q.","Surat","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("53","Esha","esha@gmail.com","$2y$10$X93Ubp205YnTHC8CKPY4QOaP3GvpMc0reQMea6nJCJ3oIheB7n57i","bharuch","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("58","Vaidehi","vaidehipanchal3@gmail.com","$2y$10$nfq/sJOX7d33tLt1yEUwfe4IQuHjq.MGGwb4oaLid0Xq4nGGnPHH.","Surat","","","2025-03-07 17:39:02");
INSERT INTO user_master VALUES("59","Khushi ahir","Khushiahir@gmail.com","$2y$10$apcdoIJit.m2vglEcdxiX.IZTUz7L7M08hkLvg5Pf.GuSzPlUWP0O","Velachha","","","2025-03-07 20:29:17");
INSERT INTO user_master VALUES("60","Krupangi","krupangi@gmail.com","$2y$10$Crk68d.PR7.s6kxENz7FWudpGniNRbMwThdDdS71dZcDU9g0cyn/u","Kim","","","2025-03-07 20:29:48");
INSERT INTO user_master VALUES("61","Dharti solanki","dhartisolanki@gmail.com","$2y$10$6pnGGxb0ungBzqM5y1t.ju5BMHa8u9AZot99DHeFDRi2hNkD5krRK","Simodra","","","2025-03-07 20:30:18");
INSERT INTO user_master VALUES("62","Sanjay Panchal","panchalsanjay689@gmail.com","$2y$10$S4Hms9QrmA0fp7o9wJsmteTN3D7HlBmMybWqayFuk62x8dPQs/x9m","Simodra","","","2025-03-11 21:24:15");
INSERT INTO user_master VALUES("63","Darshit Modi","darshitmodi@gmail.com","$2y$10$SMvxmFb4fcbYJ25yNSYlUOPBdNj6zCqMRnsMR/rSKPRtuByxCtep6","Bharuch","","","2025-03-12 09:46:32");
INSERT INTO user_master VALUES("51","Dax Panchal","dax@gamil.com","$2y$10$4mBTIw3cfVekxwCocaLGv.sm62MK9GgddVNCzTRPCLvCg5JxAT8Q.","Surat","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("53","Esha","esha@gmail.com","$2y$10$X93Ubp205YnTHC8CKPY4QOaP3GvpMc0reQMea6nJCJ3oIheB7n57i","bharuch","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("58","Vaidehi","vaidehipanchal3@gmail.com","$2y$10$nfq/sJOX7d33tLt1yEUwfe4IQuHjq.MGGwb4oaLid0Xq4nGGnPHH.","Surat","","","2025-03-07 17:39:02");
INSERT INTO user_master VALUES("59","Khushi ahir","Khushiahir@gmail.com","$2y$10$apcdoIJit.m2vglEcdxiX.IZTUz7L7M08hkLvg5Pf.GuSzPlUWP0O","Velachha","","","2025-03-07 20:29:17");
INSERT INTO user_master VALUES("60","Krupangi","krupangi@gmail.com","$2y$10$Crk68d.PR7.s6kxENz7FWudpGniNRbMwThdDdS71dZcDU9g0cyn/u","Kim","","","2025-03-07 20:29:48");
INSERT INTO user_master VALUES("61","Dharti solanki","dhartisolanki@gmail.com","$2y$10$6pnGGxb0ungBzqM5y1t.ju5BMHa8u9AZot99DHeFDRi2hNkD5krRK","Simodra","","","2025-03-07 20:30:18");
INSERT INTO user_master VALUES("62","Sanjay Panchal","panchalsanjay689@gmail.com","$2y$10$S4Hms9QrmA0fp7o9wJsmteTN3D7HlBmMybWqayFuk62x8dPQs/x9m","Simodra","","","2025-03-11 21:24:15");
INSERT INTO user_master VALUES("63","Darshit Modi","darshitmodi@gmail.com","$2y$10$SMvxmFb4fcbYJ25yNSYlUOPBdNj6zCqMRnsMR/rSKPRtuByxCtep6","Bharuch","","","2025-03-12 09:46:32");
INSERT INTO user_master VALUES("51","Dax Panchal","dax@gamil.com","$2y$10$4mBTIw3cfVekxwCocaLGv.sm62MK9GgddVNCzTRPCLvCg5JxAT8Q.","Surat","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("53","Esha","esha@gmail.com","$2y$10$X93Ubp205YnTHC8CKPY4QOaP3GvpMc0reQMea6nJCJ3oIheB7n57i","bharuch","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("58","Vaidehi","vaidehipanchal3@gmail.com","$2y$10$nfq/sJOX7d33tLt1yEUwfe4IQuHjq.MGGwb4oaLid0Xq4nGGnPHH.","Surat","","","2025-03-07 17:39:02");
INSERT INTO user_master VALUES("59","Khushi ahir","Khushiahir@gmail.com","$2y$10$apcdoIJit.m2vglEcdxiX.IZTUz7L7M08hkLvg5Pf.GuSzPlUWP0O","Velachha","","","2025-03-07 20:29:17");
INSERT INTO user_master VALUES("60","Krupangi","krupangi@gmail.com","$2y$10$Crk68d.PR7.s6kxENz7FWudpGniNRbMwThdDdS71dZcDU9g0cyn/u","Kim","","","2025-03-07 20:29:48");
INSERT INTO user_master VALUES("61","Dharti solanki","dhartisolanki@gmail.com","$2y$10$6pnGGxb0ungBzqM5y1t.ju5BMHa8u9AZot99DHeFDRi2hNkD5krRK","Simodra","","","2025-03-07 20:30:18");
INSERT INTO user_master VALUES("62","Sanjay Panchal","panchalsanjay689@gmail.com","$2y$10$S4Hms9QrmA0fp7o9wJsmteTN3D7HlBmMybWqayFuk62x8dPQs/x9m","Simodra","","","2025-03-11 21:24:15");
INSERT INTO user_master VALUES("63","Darshit Modi","darshitmodi@gmail.com","$2y$10$SMvxmFb4fcbYJ25yNSYlUOPBdNj6zCqMRnsMR/rSKPRtuByxCtep6","Bharuch","","","2025-03-12 09:46:32");
INSERT INTO user_master VALUES("51","Dax Panchal","dax@gamil.com","$2y$10$4mBTIw3cfVekxwCocaLGv.sm62MK9GgddVNCzTRPCLvCg5JxAT8Q.","Surat","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("53","Esha","esha@gmail.com","$2y$10$X93Ubp205YnTHC8CKPY4QOaP3GvpMc0reQMea6nJCJ3oIheB7n57i","bharuch","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("58","Vaidehi","vaidehipanchal3@gmail.com","$2y$10$nfq/sJOX7d33tLt1yEUwfe4IQuHjq.MGGwb4oaLid0Xq4nGGnPHH.","Surat","","","2025-03-07 17:39:02");
INSERT INTO user_master VALUES("59","Khushi ahir","Khushiahir@gmail.com","$2y$10$apcdoIJit.m2vglEcdxiX.IZTUz7L7M08hkLvg5Pf.GuSzPlUWP0O","Velachha","","","2025-03-07 20:29:17");
INSERT INTO user_master VALUES("60","Krupangi","krupangi@gmail.com","$2y$10$Crk68d.PR7.s6kxENz7FWudpGniNRbMwThdDdS71dZcDU9g0cyn/u","Kim","","","2025-03-07 20:29:48");
INSERT INTO user_master VALUES("61","Dharti solanki","dhartisolanki@gmail.com","$2y$10$6pnGGxb0ungBzqM5y1t.ju5BMHa8u9AZot99DHeFDRi2hNkD5krRK","Simodra","","","2025-03-07 20:30:18");
INSERT INTO user_master VALUES("62","Sanjay Panchal","panchalsanjay689@gmail.com","$2y$10$S4Hms9QrmA0fp7o9wJsmteTN3D7HlBmMybWqayFuk62x8dPQs/x9m","Simodra","","","2025-03-11 21:24:15");
INSERT INTO user_master VALUES("63","Darshit Modi","darshitmodi@gmail.com","$2y$10$SMvxmFb4fcbYJ25yNSYlUOPBdNj6zCqMRnsMR/rSKPRtuByxCtep6","Bharuch","","","2025-03-12 09:46:32");
INSERT INTO user_master VALUES("51","Dax Panchal","dax@gamil.com","$2y$10$4mBTIw3cfVekxwCocaLGv.sm62MK9GgddVNCzTRPCLvCg5JxAT8Q.","Surat","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("53","Esha","esha@gmail.com","$2y$10$X93Ubp205YnTHC8CKPY4QOaP3GvpMc0reQMea6nJCJ3oIheB7n57i","bharuch","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("58","Vaidehi","vaidehipanchal3@gmail.com","$2y$10$nfq/sJOX7d33tLt1yEUwfe4IQuHjq.MGGwb4oaLid0Xq4nGGnPHH.","Surat","","","2025-03-07 17:39:02");
INSERT INTO user_master VALUES("59","Khushi ahir","Khushiahir@gmail.com","$2y$10$apcdoIJit.m2vglEcdxiX.IZTUz7L7M08hkLvg5Pf.GuSzPlUWP0O","Velachha","","","2025-03-07 20:29:17");
INSERT INTO user_master VALUES("60","Krupangi","krupangi@gmail.com","$2y$10$Crk68d.PR7.s6kxENz7FWudpGniNRbMwThdDdS71dZcDU9g0cyn/u","Kim","","","2025-03-07 20:29:48");
INSERT INTO user_master VALUES("61","Dharti solanki","dhartisolanki@gmail.com","$2y$10$6pnGGxb0ungBzqM5y1t.ju5BMHa8u9AZot99DHeFDRi2hNkD5krRK","Simodra","","","2025-03-07 20:30:18");
INSERT INTO user_master VALUES("62","Sanjay Panchal","panchalsanjay689@gmail.com","$2y$10$S4Hms9QrmA0fp7o9wJsmteTN3D7HlBmMybWqayFuk62x8dPQs/x9m","Simodra","","","2025-03-11 21:24:15");
INSERT INTO user_master VALUES("63","Darshit Modi","darshitmodi@gmail.com","$2y$10$SMvxmFb4fcbYJ25yNSYlUOPBdNj6zCqMRnsMR/rSKPRtuByxCtep6","Bharuch","","","2025-03-12 09:46:32");
INSERT INTO user_master VALUES("51","Dax Panchal","dax@gamil.com","$2y$10$4mBTIw3cfVekxwCocaLGv.sm62MK9GgddVNCzTRPCLvCg5JxAT8Q.","Surat","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("53","Esha","esha@gmail.com","$2y$10$X93Ubp205YnTHC8CKPY4QOaP3GvpMc0reQMea6nJCJ3oIheB7n57i","bharuch","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("58","Vaidehi","vaidehipanchal3@gmail.com","$2y$10$nfq/sJOX7d33tLt1yEUwfe4IQuHjq.MGGwb4oaLid0Xq4nGGnPHH.","Surat","","","2025-03-07 17:39:02");
INSERT INTO user_master VALUES("59","Khushi ahir","Khushiahir@gmail.com","$2y$10$apcdoIJit.m2vglEcdxiX.IZTUz7L7M08hkLvg5Pf.GuSzPlUWP0O","Velachha","","","2025-03-07 20:29:17");
INSERT INTO user_master VALUES("60","Krupangi","krupangi@gmail.com","$2y$10$Crk68d.PR7.s6kxENz7FWudpGniNRbMwThdDdS71dZcDU9g0cyn/u","Kim","","","2025-03-07 20:29:48");
INSERT INTO user_master VALUES("61","Dharti solanki","dhartisolanki@gmail.com","$2y$10$6pnGGxb0ungBzqM5y1t.ju5BMHa8u9AZot99DHeFDRi2hNkD5krRK","Simodra","","","2025-03-07 20:30:18");
INSERT INTO user_master VALUES("62","Sanjay Panchal","panchalsanjay689@gmail.com","$2y$10$S4Hms9QrmA0fp7o9wJsmteTN3D7HlBmMybWqayFuk62x8dPQs/x9m","Simodra","","","2025-03-11 21:24:15");
INSERT INTO user_master VALUES("63","Darshit Modi","darshitmodi@gmail.com","$2y$10$SMvxmFb4fcbYJ25yNSYlUOPBdNj6zCqMRnsMR/rSKPRtuByxCtep6","Bharuch","","","2025-03-12 09:46:32");
INSERT INTO user_master VALUES("51","Dax Panchal","dax@gamil.com","$2y$10$4mBTIw3cfVekxwCocaLGv.sm62MK9GgddVNCzTRPCLvCg5JxAT8Q.","Surat","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("53","Esha","esha@gmail.com","$2y$10$X93Ubp205YnTHC8CKPY4QOaP3GvpMc0reQMea6nJCJ3oIheB7n57i","bharuch","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("58","Vaidehi","vaidehipanchal3@gmail.com","$2y$10$nfq/sJOX7d33tLt1yEUwfe4IQuHjq.MGGwb4oaLid0Xq4nGGnPHH.","Surat","","","2025-03-07 17:39:02");
INSERT INTO user_master VALUES("59","Khushi ahir","Khushiahir@gmail.com","$2y$10$apcdoIJit.m2vglEcdxiX.IZTUz7L7M08hkLvg5Pf.GuSzPlUWP0O","Velachha","","","2025-03-07 20:29:17");
INSERT INTO user_master VALUES("60","Krupangi","krupangi@gmail.com","$2y$10$Crk68d.PR7.s6kxENz7FWudpGniNRbMwThdDdS71dZcDU9g0cyn/u","Kim","","","2025-03-07 20:29:48");
INSERT INTO user_master VALUES("61","Dharti solanki","dhartisolanki@gmail.com","$2y$10$6pnGGxb0ungBzqM5y1t.ju5BMHa8u9AZot99DHeFDRi2hNkD5krRK","Simodra","","","2025-03-07 20:30:18");
INSERT INTO user_master VALUES("62","Sanjay Panchal","panchalsanjay689@gmail.com","$2y$10$S4Hms9QrmA0fp7o9wJsmteTN3D7HlBmMybWqayFuk62x8dPQs/x9m","Simodra","","","2025-03-11 21:24:15");
INSERT INTO user_master VALUES("63","Darshit Modi","darshitmodi@gmail.com","$2y$10$SMvxmFb4fcbYJ25yNSYlUOPBdNj6zCqMRnsMR/rSKPRtuByxCtep6","Bharuch","","","2025-03-12 09:46:32");
INSERT INTO user_master VALUES("51","Dax Panchal","dax@gamil.com","$2y$10$4mBTIw3cfVekxwCocaLGv.sm62MK9GgddVNCzTRPCLvCg5JxAT8Q.","Surat","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("53","Esha","esha@gmail.com","$2y$10$X93Ubp205YnTHC8CKPY4QOaP3GvpMc0reQMea6nJCJ3oIheB7n57i","bharuch","","","2025-02-27 15:22:58");
INSERT INTO user_master VALUES("58","Vaidehi","vaidehipanchal3@gmail.com","$2y$10$nfq/sJOX7d33tLt1yEUwfe4IQuHjq.MGGwb4oaLid0Xq4nGGnPHH.","Surat","","","2025-03-07 17:39:02");
INSERT INTO user_master VALUES("59","Khushi ahir","Khushiahir@gmail.com","$2y$10$apcdoIJit.m2vglEcdxiX.IZTUz7L7M08hkLvg5Pf.GuSzPlUWP0O","Velachha","","","2025-03-07 20:29:17");
INSERT INTO user_master VALUES("60","Krupangi","krupangi@gmail.com","$2y$10$Crk68d.PR7.s6kxENz7FWudpGniNRbMwThdDdS71dZcDU9g0cyn/u","Kim","","","2025-03-07 20:29:48");
INSERT INTO user_master VALUES("61","Dharti solanki","dhartisolanki@gmail.com","$2y$10$6pnGGxb0ungBzqM5y1t.ju5BMHa8u9AZot99DHeFDRi2hNkD5krRK","Simodra","","","2025-03-07 20:30:18");
INSERT INTO user_master VALUES("62","Sanjay Panchal","panchalsanjay689@gmail.com","$2y$10$S4Hms9QrmA0fp7o9wJsmteTN3D7HlBmMybWqayFuk62x8dPQs/x9m","Simodra","","","2025-03-11 21:24:15");
INSERT INTO user_master VALUES("63","Darshit Modi","darshitmodi@gmail.com","$2y$10$SMvxmFb4fcbYJ25yNSYlUOPBdNj6zCqMRnsMR/rSKPRtuByxCtep6","Bharuch","","","2025-03-12 09:46:32");



