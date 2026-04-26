-- sample_data.sql
-- Run this script against your isaaq_isak database to create the required
-- tables and load sample content for the Isaaq Kingdom website.
--
-- Usage (from cPanel terminal or phpMyAdmin):
--   mysql -u isaaq_isak -p isaaq_isak < sample_data.sql

-- ============================================================
-- TABLE DEFINITIONS
-- ============================================================

CREATE TABLE IF NOT EXISTS slides (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    headline    VARCHAR(255) NOT NULL,
    tagline     VARCHAR(255) NOT NULL,
    description TEXT         NOT NULL,
    image_path  VARCHAR(500) NOT NULL DEFAULT '',
    slide_order INT          NOT NULL DEFAULT 0,
    is_active   TINYINT(1)   NOT NULL DEFAULT 1,
    created_at  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS news (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    category    VARCHAR(100) NOT NULL,
    description TEXT         NOT NULL,
    image_path  VARCHAR(500) NOT NULL DEFAULT '',
    is_active   TINYINT(1)   NOT NULL DEFAULT 1,
    created_at  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS events (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    event_name  VARCHAR(255) NOT NULL,
    event_year  VARCHAR(20)  NOT NULL,
    description TEXT         NOT NULL,
    extra_info  TEXT,
    is_active   TINYINT(1)   NOT NULL DEFAULT 1,
    created_at  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS lineage_banner (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    banner_text TEXT        NOT NULL,
    is_active   TINYINT(1)  NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- SAMPLE DATA – SLIDES
-- ============================================================

INSERT INTO slides (headline, tagline, description, image_path, slide_order) VALUES
(
    'Welcome to the Isaaq Kingdom',
    'Tolje\'lo Dynasty · Eight Kings · Eight Centuries',
    'Discover the living legacy of the Isaaq Kingdom — a rich tapestry of sovereignty, Islamic scholarship, and Somali heritage.',
    'images/slide-kingdom.jpg',
    1
),
(
    'King Dhuuh Baraar',
    'The Last Sovereign of the Tolje\'lo Dynasty',
    'Revered as the eighth and final king of the Tolje\'lo line, King Dhuuh Baraar\'s reign cemented the cultural and spiritual identity of the Isaaq people.',
    'images/slide-king.jpg',
    2
),
(
    'Sheikh Ishaaq Bin Ahmed',
    '12th-Century Scholar & Founding Father',
    'A learned Qureshi scholar who sailed to the Horn of Africa, married into the region, and became the ancestor of the eight great Isaaq clans.',
    'images/slide-sheikh.jpg',
    3
);

-- ============================================================
-- SAMPLE DATA – NEWS
-- ============================================================

INSERT INTO news (title, category, description, image_path) VALUES
(
    'Annual Heritage Commemoration 2025',
    'Heritage',
    'The Isaaq community gathered in Hargeisa for the annual Tolje\'lo heritage day. Elders delivered the oral history of the eight kings while traditional poetry (gabay) was performed in the open courtyard of the old city. The event drew thousands of attendees from across Somaliland and the diaspora.',
    'images/news-heritage-2025.jpg'
),
(
    'Restoration of Sheikh Ishaaq\'s Mausoleum Begins',
    'Culture',
    'Work has officially started on the preservation of the historic mausoleum in Maydh. The project, funded by the Isaaq Cultural Foundation, aims to restore the 800-year-old site to its former glory and establish an on-site museum cataloguing manuscripts and artefacts.',
    'images/news-mausoleum.jpg'
),
(
    'Youth Leadership Summit – Carrying the Legacy Forward',
    'Community',
    'Over 200 young Isaaq leaders participated in a three-day summit focused on the kingdom\'s governance traditions, xeer customary law, and strategies for preserving cultural identity in the modern era. Keynote addresses were delivered by senior Guurti council members.',
    'images/news-youth-summit.jpg'
),
(
    'New Documentary: "Eight Kings of the North"',
    'Media',
    'A full-length documentary tracing the reigns of the eight Tolje\'lo kings has been completed and will premiere next month. The film blends archival photographs, oral testimony, and animated maps to bring the kingdom\'s history to life for global audiences.',
    'images/news-documentary.jpg'
);

-- ============================================================
-- SAMPLE DATA – EVENTS
-- ============================================================

INSERT INTO events (event_name, event_year, description, extra_info) VALUES
(
    'Tolje\'lo Heritage Day',
    '2025',
    'Annual gathering to honour the memory of the eight Tolje\'lo kings. Ceremonies include recitation of royal lineage, traditional poetry, and a community feast.',
    'Held every year on the last Friday of April in Hargeisa, Somaliland.'
),
(
    'Sheikh Ishaaq Memorial Pilgrimage',
    '2025',
    'Communities travel to Maydh on the northern coast to pay respects at the mausoleum of Sheikh Ishaaq Bin Ahmed, the founding patriarch of the Isaaq clans.',
    'Open to all Isaaq clan members and respectful visitors. Transport arranged from Berbera.'
),
(
    'Guurti Council Assembly',
    '2024',
    'Senior Guurti elders assembled to review customary law (xeer) and address inter-clan matters in accordance with centuries-old traditions of the Isaaq Kingdom.',
    'Closed session; summary resolutions published publicly thereafter.'
),
(
    'Royal Lineage Oral History Workshop',
    '2024',
    'A two-day workshop where master oral historians (odayaasha) recorded and transcribed the complete lineage of the Tolje\'lo dynasty for archival preservation.',
    'Recordings deposited with the Somaliland National Archive and the Isaaq Cultural Foundation.'
),
(
    'Foundation of the Tolje\'lo Dynasty',
    '~1300s',
    'King Harun, the first Tolje\'lo ruler, established the Isaaq Kingdom following the decline of the Adal Sultanate, uniting the Isaaq clans under a single royal house.',
    'Historical event — commemorated annually.'
),
(
    'Reign of King Dhuuh Baraar',
    '~1700s',
    'The eighth and final Tolje\'lo king consolidated the spiritual and cultural institutions of the kingdom, leaving a legacy that endures in modern Somali society.',
    'Historical event — subject of ongoing scholarly research.'
);

-- ============================================================
-- SAMPLE DATA – LINEAGE BANNER
-- ============================================================

INSERT INTO lineage_banner (banner_text, is_active) VALUES
(
    'Sheikh Ishaaq Bin Ahmed → King Harun (1st) → King Ali (2nd) → King Ibrahim (3rd) → King Darod (4th) → King Musa (5th) → King Hasan (6th) → King Qaalib (7th) → King Dhuuh Baraar (8th)',
    1
);
