
CREATE TABLE document_cache(
    document_id INT NOT NULL,
    part INT NOT NULL,
    type enum('pdf', 'png') NOT NULL,
    content BLOB NOT NULL,
    created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)
