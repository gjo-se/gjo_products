CREATE TABLE tx_gjoproducts_domain_model_product
(
    name                   varchar(150)     DEFAULT ''  NOT NULL,
    article_number         varchar(150)     DEFAULT ''  NOT NULL,
    additional_information varchar(150)     DEFAULT ''  NOT NULL,
    image                  int(11) unsigned DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_gjoproducts_domain_model_productgroup
(
    product_set_types  int(11) unsigned NOT NULL DEFAULT '0',
    pages              INT(11) unsigned NOT NULL DEFAULT '0',

    header             varchar(150)     NOT NULL DEFAULT '',
    sub_header         varchar(150)     NOT NULL DEFAULT '',
    description        TEXT             NULL,
    image              int(11) unsigned NOT NULL DEFAULT '0',
    teaser_header      varchar(150)     NOT NULL DEFAULT '',
    teaser_description TEXT             NULL,
    teaser_image       int(11) unsigned NOT NULL DEFAULT '0',
);

CREATE TABLE tx_gjoproducts_domain_model_productsettype
(
    product_group int(11) unsigned NOT NULL DEFAULT '0',
    product_sets  INT(11) unsigned NOT NULL DEFAULT '0',

    name          varchar(150)     NOT NULL DEFAULT '',
    description   TEXT             NULL,
);

CREATE TABLE tx_gjoproducts_domain_model_productset
(
    product_set_variant_groups         int(11) unsigned NOT NULL DEFAULT '0',
    accessorykit_groups                int(11) unsigned NOT NULL DEFAULT '0',
    pages                              INT(11) unsigned NOT NULL DEFAULT '0',

    name                               varchar(150)     NOT NULL DEFAULT '',
    anchor                             varchar(150)     NOT NULL DEFAULT '',
    is_accessory_kit                   TINYINT(4)       NOT NULL DEFAULT '0',
    is_featured                        TINYINT(4)       NOT NULL DEFAULT '0',
    description                        TEXT             NULL,
    image                              int(11) unsigned NOT NULL DEFAULT '0',
    icon                               int(11) unsigned NOT NULL DEFAULT '0',
    show_technicalnots                 tinyint(4) unsigned       DEFAULT '0' NOT NULL,
    minimum_door_weight                INT(11)          NOT NULL DEFAULT '0',
    maximum_door_weight                INT(11)          NOT NULL DEFAULT '0',
    height                             varchar(150)     NOT NULL DEFAULT '',
    minimum_door_thickness             INT(11)          NOT NULL DEFAULT '0',
    maximum_door_thickness             INT(11)          NOT NULL DEFAULT '0',
    minimum_door_width                 INT(11)          NOT NULL DEFAULT '0',
    minimum_door_width_soft_close      INT(11)          NOT NULL DEFAULT '0',
    minimum_door_width_soft_close_long INT(11)          NOT NULL DEFAULT '0',
    minimum_door_width_soft_close_both INT(11)          NOT NULL DEFAULT '0',
    maximum_door_width                 INT(11)          NOT NULL DEFAULT '0',
    voltage                            varchar(150)     NOT NULL DEFAULT '',
    show_din                           tinyint(4) unsigned       DEFAULT '0' NOT NULL,
    use_categorie                      varchar(150)     NOT NULL DEFAULT '',
    durability                         varchar(150)     NOT NULL DEFAULT '',
    door_weight                        varchar(150)     NOT NULL DEFAULT '',
    fire_resistance                    varchar(150)     NOT NULL DEFAULT '',
    safety                             varchar(150)     NOT NULL DEFAULT '',
    corrosion_resistance               varchar(150)     NOT NULL DEFAULT '',
    security                           varchar(150)     NOT NULL DEFAULT '',
    door_type                          varchar(150)     NOT NULL DEFAULT '',
    initial_friction                   varchar(150)     NOT NULL DEFAULT '',
    invitation_to_tender               TEXT             NULL,
    download                           int(11) unsigned NOT NULL DEFAULT '0',
    download_engineering_drawing       int(11) unsigned NOT NULL DEFAULT '0',
    image_engineering_drawing          int(11) unsigned NOT NULL DEFAULT '0',
    filter_material_wood               TINYINT(4)       NOT NULL DEFAULT '0',
    filter_material_glas               TINYINT(4)       NOT NULL DEFAULT '0',
    filter_wingcount                   varchar(10)      NOT NULL DEFAULT '',
    filter_design_customer             TINYINT(4)       NOT NULL DEFAULT '0',
    filter_design_alu                  TINYINT(4)       NOT NULL DEFAULT '0',
    filter_design_design               TINYINT(4)       NOT NULL DEFAULT '0',
    filter_soft_close                  TINYINT(4)       NOT NULL DEFAULT '0',
    filter_et3                         TINYINT(4)       NOT NULL DEFAULT '0',
    filter_tclose                      TINYINT(4)       NOT NULL DEFAULT '0',
    filter_tmaster                     TINYINT(4)       NOT NULL DEFAULT '0',
    filter_tfold                       TINYINT(4)       NOT NULL DEFAULT '0',
    filter_synchron                    TINYINT(4)       NOT NULL DEFAULT '0',
    filter_telescop2                   TINYINT(4)       NOT NULL DEFAULT '0',
    filter_telescop3                   TINYINT(4)       NOT NULL DEFAULT '0',
    filter_montage_wall                TINYINT(4)       NOT NULL DEFAULT '0',
    filter_montage_ceiling             TINYINT(4)       NOT NULL DEFAULT '0',
    filter_montage_in                  TINYINT(4)       NOT NULL DEFAULT '0',
);

CREATE TABLE tx_gjoproducts_domain_model_productsetvariantgroup
(
    product_set          int(11) unsigned NOT NULL DEFAULT '0',
    products             int(11) unsigned NOT NULL DEFAULT '0',
    product_set_variants int(11) unsigned NOT NULL DEFAULT '0',

    headline             varchar(150)     NOT NULL DEFAULT '',
    description          TEXT             NULL,
    table_headline       varchar(150)     NOT NULL DEFAULT '',
);

CREATE TABLE tx_gjoproducts_domain_model_accessorykitgroup
(
    product_set    int(11) unsigned NOT NULL DEFAULT '0',
    accessory_kits int(11) unsigned NOT NULL DEFAULT '0',

    headline       varchar(150)     NOT NULL DEFAULT '',
);

CREATE TABLE tx_gjoproducts_domain_model_productsetvariant
(
    product_set_variant_group int(11) unsigned NOT NULL DEFAULT '0',

    name                      varchar(200)     NOT NULL DEFAULT '',
    article_number            varchar(150)     NOT NULL DEFAULT '',
    price                     DOUBLE           NOT NULL DEFAULT '0',
    tax                       TINYINT(4)       NOT NULL DEFAULT '0',
    material                  varchar(20)      NOT NULL DEFAULT '',
    length                    INT(10)          NOT NULL DEFAULT '0',
    version                   varchar(50)      NOT NULL DEFAULT '',
);


CREATE TABLE tx_gjoproducts_product_productsetvariantgroup_mm
(
    uid_local       int(11) unsigned DEFAULT '0' NOT NULL,
    uid_foreign     int(11) unsigned DEFAULT '0' NOT NULL,
    sorting         int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,
    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_gjoproducts_productset_accessorykit_mm
(
    uid_local       int(11) unsigned DEFAULT '0' NOT NULL,
    uid_foreign     int(11) unsigned DEFAULT '0' NOT NULL,
    sorting         int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,
    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)
);

CREATE TABLE tx_gjoproducts_productset_productsettype_mm
(
    uid_local       int(11) unsigned DEFAULT '0' NOT NULL,
    uid_foreign     int(11) unsigned DEFAULT '0' NOT NULL,
    sorting         int(11) unsigned DEFAULT '0' NOT NULL,
    sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,
    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)
);