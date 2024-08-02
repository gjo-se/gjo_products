CREATE TABLE tx_gjoproducts_domain_model_product
(
    name                   varchar(150)     DEFAULT ''  NOT NULL,
    article_number         varchar(150)     DEFAULT ''  NOT NULL,
    additional_information varchar(150)     DEFAULT ''  NOT NULL,
    image                  int(11) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE tx_gjoproducts_domain_model_productset
(
    name                               varchar(150)     NOT NULL DEFAULT '',
    anchor                             varchar(150)     NOT NULL DEFAULT '',
    is_accessory_kit                   int(11)          NOT NULL DEFAULT '0',
    is_featured                        int(11)          NOT NULL DEFAULT '0',
    description                        text             NULL,
    image                              int(11) unsigned NOT NULL DEFAULT '0',
    icon                               int(11) unsigned NOT NULL DEFAULT '0',
    show_technicalnots                 int(11)          NOT NULL DEFAULT '0',
    minimum_door_weight                int(11)          NOT NULL DEFAULT '0',
    maximum_door_weight                int(11)          NOT NULL DEFAULT '0',
    height                             varchar(150)     NOT NULL DEFAULT '',
    minimum_door_thickness             int(11)          NOT NULL DEFAULT '0',
    maximum_door_thickness             int(11)          NOT NULL DEFAULT '0',
    minimum_door_width                 int(11)          NOT NULL DEFAULT '0',
    minimum_door_width_soft_close      int(11)          NOT NULL DEFAULT '0',
    minimum_door_width_soft_close_long int(11)          NOT NULL DEFAULT '0',
    minimum_door_width_soft_close_both int(11)          NOT NULL DEFAULT '0',
    maximum_door_width                 int(11)          NOT NULL DEFAULT '0',
    voltage                            varchar(150)     NOT NULL DEFAULT '',
    show_din                           int(11)          NOT NULL DEFAULT '0',
    use_categorie                      varchar(150)     NOT NULL DEFAULT '',
    durability                         varchar(150)     NOT NULL DEFAULT '',
    door_weight                        varchar(150)     NOT NULL DEFAULT '',
    fire_resistance                    varchar(150)     NOT NULL DEFAULT '',
    safety                             varchar(150)     NOT NULL DEFAULT '',
    corrosion_resistance               varchar(150)     NOT NULL DEFAULT '',
    security                           varchar(150)     NOT NULL DEFAULT '',
    door_type                          varchar(150)     NOT NULL DEFAULT '',
    initial_friction                   varchar(150)     NOT NULL DEFAULT '',
    invitation_to_tender               text             NULL,
    download                           int(11) unsigned NOT NULL DEFAULT '0',
    download_engineering_drawing       int(11) unsigned NOT NULL DEFAULT '0',
    image_engineering_drawing          int(11) unsigned NOT NULL DEFAULT '0',
    filter_material_wood               int(11)          NOT NULL DEFAULT '0',
    filter_material_glas               int(11)          NOT NULL DEFAULT '0',
    filter_wingcount                   varchar(150)     NOT NULL DEFAULT '',
    filter_design_customer             int(11)          NOT NULL DEFAULT '0',
    filter_design_alu                  int(11)          NOT NULL DEFAULT '0',
    filter_design_design               int(11)          NOT NULL DEFAULT '0',
    filter_soft_close                  int(11)          NOT NULL DEFAULT '0',
    filter_et3                         int(11)          NOT NULL DEFAULT '0',
    filter_tclose                      int(11)          NOT NULL DEFAULT '0',
    filter_tmaster                     int(11)          NOT NULL DEFAULT '0',
    filter_tfold                       int(11)          NOT NULL DEFAULT '0',
    filter_synchron                    int(11)          NOT NULL DEFAULT '0',
    filter_telescop2                   int(11)          NOT NULL DEFAULT '0',
    filter_telescop3                   int(11)          NOT NULL DEFAULT '0',
    filter_montage_wall                int(11)          NOT NULL DEFAULT '0',
    filter_montage_ceiling             int(11)          NOT NULL DEFAULT '0',
    filter_montage_in                  int(11)          NOT NULL DEFAULT '0',

    product_set_variant_groups         int(11) unsigned NOT NULL DEFAULT '0',
    accessorykit_groups                int(11) unsigned NOT NULL DEFAULT '0',
    pages                              int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_gjoproducts_domain_model_productsetvariant
(
    name                      varchar(200)     NOT NULL DEFAULT '',
    article_number            varchar(150)     NOT NULL DEFAULT '',
    price                     double           NOT NULL DEFAULT '0',
    tax                       int(11)          NOT NULL DEFAULT '0',
    material                  varchar(20)      NOT NULL DEFAULT '',
    length                    int(10)          NOT NULL DEFAULT '0',
    version                   varchar(50)      NOT NULL DEFAULT '',

    product_set_variant_group int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_gjoproducts_domain_model_productgroup
(
    header             varchar(150)     NOT NULL DEFAULT '',
    sub_header         varchar(150)     NOT NULL DEFAULT '',
    description        text             NULL,
    image              int(11) unsigned NOT NULL DEFAULT '0',
    teaser_header      varchar(150)     NOT NULL DEFAULT '',
    teaser_description text             NULL,
    teaser_image       int(11) unsigned NOT NULL DEFAULT '0',

    product_set_types  int(11) unsigned NOT NULL DEFAULT '0',
    page               int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_gjoproducts_domain_model_productsettype
(
    name          varchar(150)     NOT NULL DEFAULT '',
    description   text             NULL,

    product_group int(11) unsigned NOT NULL DEFAULT '0',
    product_sets  int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_gjoproducts_domain_model_productsetvariantgroup
(
    headline             varchar(150)     NOT NULL DEFAULT '',
    description          text             NULL,
    table_headline       varchar(150)     NOT NULL DEFAULT '',

    product_set          int(11) unsigned NOT NULL DEFAULT '0',
    products             int(11) unsigned NOT NULL DEFAULT '0',
    product_set_variants int(11) unsigned NOT NULL DEFAULT '0'
);

CREATE TABLE tx_gjoproducts_domain_model_accessorykitgroup
(
    headline       varchar(150)     NOT NULL DEFAULT '',

    product_set    int(11) unsigned NOT NULL DEFAULT '0',
    accessory_kits int(11) unsigned NOT NULL DEFAULT '0'
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