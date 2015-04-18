CREATE TABLE /*TABLE_PREFIX*/t_item_tags (
    fk_i_item_id INT(10) UNSIGNED NOT NULL,
    tags VARCHAR(100) NULL,

        PRIMARY KEY (fk_i_item_id),
        FOREIGN KEY (fk_i_item_id) REFERENCES /*TABLE_PREFIX*/t_item (pk_i_id)
) ENGINE=InnoDB DEFAULT CHARACTER SET 'UTF8' COLLATE 'UTF8_GENERAL_CI' ;
