-- sample_data.sql
-- Run this script once to create and populate all required tables.

-- ============================================================
-- TABLE: slides
-- ============================================================
CREATE TABLE IF NOT EXISTS `slides` (
  `id`          INT AUTO_INCREMENT PRIMARY KEY,
  `headline`    VARCHAR(255) NOT NULL,
  `tagline`     VARCHAR(255) NOT NULL DEFAULT '',
  `description` TEXT         NOT NULL DEFAULT '',
  `image_path`  VARCHAR(512) NOT NULL DEFAULT '',
  `slide_order` INT          NOT NULL DEFAULT 0,
  `is_active`   TINYINT(1)   NOT NULL DEFAULT 1,
  `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `slides` (`headline`, `tagline`, `description`, `image_path`, `slide_order`) VALUES
('The Isaaq Kingdom',          'Tolje\'lo Dynasty',           'A thousand years of noble heritage and royal lineage.', 'https://images.unsplash.com/photo-1466781783364-36c955e42a7f?w=1600', 1),
('King Dhuuh Baraar',          'Last Sovereign of the North', 'Guardian of tradition, strength, and the people\'s honour.', 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?w=1600', 2),
('Royal Heritage Preserved',   'Eight Kings — One Legacy',    'Centuries of wisdom, culture, and royal ceremony live on.', 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1600', 3);

-- ============================================================
-- TABLE: news
-- ============================================================
CREATE TABLE IF NOT EXISTS `news` (
  `id`          INT AUTO_INCREMENT PRIMARY KEY,
  `title`       VARCHAR(255) NOT NULL,
  `category`    VARCHAR(100) NOT NULL DEFAULT 'General',
  `description` TEXT         NOT NULL DEFAULT '',
  `image_path`  VARCHAR(512) NOT NULL DEFAULT '',
  `is_active`   TINYINT(1)   NOT NULL DEFAULT 1,
  `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `news` (`title`, `category`, `description`, `image_path`) VALUES
('Royal Council Convenes for Annual Gathering',
 'Royal Affairs',
 'The Isaaq Royal Council held its annual meeting in the ancestral hall, bringing together elders and tribal leaders from across the kingdom to discuss matters of heritage and governance.',
 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800'),

('New Heritage Museum Opens in Hargeisa',
 'Culture',
 'A new museum dedicated to Isaaq history and the Tolje\'lo dynasty has opened its doors to the public. Artefacts spanning eight centuries are now on display for visitors from around the world.',
 'https://images.unsplash.com/photo-1518998053901-5348d3961a04?w=800'),

('Annual Poetry Festival Celebrates Somali Oral Tradition',
 'Events',
 'Poets and storytellers gathered for the annual Gabay festival, celebrating the rich oral tradition that has preserved Isaaq history across generations.',
 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800'),

('Royal Scholarship Programme Launched for Youth',
 'Education',
 'The Isaaq Kingdom has launched a scholarship programme to support young students in preserving and studying the dynasty\'s rich cultural heritage.',
 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800');

-- ============================================================
-- TABLE: events
-- ============================================================
CREATE TABLE IF NOT EXISTS `events` (
  `id`          INT AUTO_INCREMENT PRIMARY KEY,
  `event_name`  VARCHAR(255) NOT NULL,
  `event_year`  VARCHAR(20)  NOT NULL,
  `description` TEXT         NOT NULL DEFAULT '',
  `extra_info`  TEXT         NOT NULL DEFAULT '',
  `is_active`   TINYINT(1)   NOT NULL DEFAULT 1,
  `created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `events` (`event_name`, `event_year`, `description`, `extra_info`) VALUES
('Foundation of the Tolje\'lo Dynasty',
 '1300',
 'The Isaaq Kingdom was formally established under the Tolje\'lo clan, marking the beginning of a proud royal lineage that would endure for centuries.',
 'Commemorated annually every spring'),

('Coronation of King Dhuuh Baraar',
 '1920',
 'The last sovereign of the Tolje\'lo dynasty was crowned in a grand ceremony attended by tribal leaders and foreign dignitaries from across the Horn of Africa.',
 'Historical records held in the Royal Archive'),

('Heritage Summit & Cultural Festival',
 '2025',
 'A modern gathering bringing together diaspora communities to celebrate Isaaq heritage, oral poetry, and traditional arts.',
 'Annual event — next edition April 2026'),

('Royal Archive Digitisation Project',
 '2026',
 'The Isaaq Kingdom partners with international historians to digitise and preserve centuries-old manuscripts, photographs, and royal decrees.',
 'Open for public access later in 2026');

-- ============================================================
-- TABLE: lineage_banner
-- ============================================================
CREATE TABLE IF NOT EXISTS `lineage_banner` (
  `id`          INT AUTO_INCREMENT PRIMARY KEY,
  `banner_text` TEXT      NOT NULL,
  `is_active`   TINYINT(1) NOT NULL DEFAULT 1,
  `updated_at`  TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `lineage_banner` (`banner_text`) VALUES
('Isaaq · Sheikh Isaaq ibn Ahmed · Tolje\'lo Dynasty · Eight Kings · One Eternal Legacy · Honour · Heritage · Sovereignty');
