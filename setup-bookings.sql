-- Create bookings table
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bus_route_id` bigint(20) UNSIGNED NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_phone` varchar(255) NOT NULL,
  `seat_number` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `status` enum('confirmed','cancelled','pending') DEFAULT 'confirmed',
  `amount_paid` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_seat_booking` (`bus_route_id`,`seat_number`,`booking_date`),
  KEY `bookings_bus_route_id_foreign` (`bus_route_id`),
  CONSTRAINT `bookings_bus_route_id_foreign` FOREIGN KEY (`bus_route_id`) REFERENCES `bus_routes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample bookings
INSERT INTO `bookings` (`bus_route_id`, `student_name`, `student_id`, `student_email`, `student_phone`, `seat_number`, `booking_date`, `status`, `amount_paid`, `created_at`, `updated_at`) VALUES
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Anika Rahman', '19101234', 'anika.rahman@bracu.ac.bd', '01712345678', 1, CURDATE(), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Fahim Ahmed', '20101567', 'fahim.ahmed@bracu.ac.bd', '01823456789', 3, CURDATE(), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Nusrat Jahan', '19101890', 'nusrat.jahan@bracu.ac.bd', '01734567890', 5, CURDATE(), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Tamim Hasan', '20102123', 'tamim.hasan@bracu.ac.bd', '01645678901', 7, CURDATE(), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Sadia Islam', '19102456', 'sadia.islam@bracu.ac.bd', '01956789012', 10, CURDATE(), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Rafiq Khan', '20102789', 'rafiq.khan@bracu.ac.bd', '01867890123', 12, CURDATE(), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Mehnaz Chowdhury', '19103012', 'mehnaz.chow@bracu.ac.bd', '01778901234', 15, CURDATE(), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Shakib Mahmud', '20103345', 'shakib.mahmud@bracu.ac.bd', '01689012345', 18, CURDATE(), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Priya Das', '19103678', 'priya.das@bracu.ac.bd', '01590123456', 2, DATE_ADD(CURDATE(), INTERVAL 1 DAY), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-101'), 'Imran Hossain', '20103901', 'imran.hossain@bracu.ac.bd', '01401234567', 4, DATE_ADD(CURDATE(), INTERVAL 1 DAY), 'confirmed', 50.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-201'), 'Labiba Tabassum', '19104234', 'labiba.tab@bracu.ac.bd', '01312345678', 1, CURDATE(), 'confirmed', 45.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-201'), 'Rafi Karim', '20104567', 'rafi.karim@bracu.ac.bd', '01223456789', 3, CURDATE(), 'confirmed', 45.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-201'), 'Nadia Sultana', '19104890', 'nadia.sultana@bracu.ac.bd', '01134567890', 6, CURDATE(), 'confirmed', 45.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-201'), 'Kamal Uddin', '20105123', 'kamal.uddin@bracu.ac.bd', '01945678901', 9, CURDATE(), 'confirmed', 45.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-201'), 'Fariha Akter', '19105456', 'fariha.akter@bracu.ac.bd', '01856789012', 11, CURDATE(), 'confirmed', 45.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-301'), 'Tanvir Ahmed', '19106234', 'tanvir.ahmed@bracu.ac.bd', '01767890123', 2, CURDATE(), 'confirmed', 40.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-301'), 'Bushra Khan', '20106567', 'bushra.khan@bracu.ac.bd', '01678901234', 5, CURDATE(), 'confirmed', 40.00, NOW(), NOW()),
((SELECT id FROM bus_routes WHERE route_number = 'BRACU-301'), 'Mahir Rahman', '19106890', 'mahir.rahman@bracu.ac.bd', '01589012345', 8, CURDATE(), 'confirmed', 40.00, NOW(), NOW());
