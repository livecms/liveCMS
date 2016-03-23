<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"              => ":attribute harus disetujui.",
    "active_url"            => ":attribute bukan valid URL.",
    "after"                 => ":attribute harus berupa tanggal setelah :date.",
    "alpha"                 => ":attribute hanya boleh berupa kata.",
    "alpha_dash"            => ":attribute hanya boleh berupa kata, nomor, and penghubung.",
    "alpha_num"             => ":attribute hanya boleh berupa kata and nomor.",
    "array"                 => ":attribute harus berupa array.",
    "before"                => ":attribute harus berupa tanggal sebelum :date.",
    "between"               => array(
        "numeric"           => ":attribute harus diantara :min - :max.",
        "file"              => ":attribute harus diantara :min - :max KB.",
        "string"            => ":attribute harus diantara :min - :max karakter.",
        "array"             => ":attribute harus diantara :min and :max items.",
    ),
    "boolean"               => ":attribute harus berupa true atau false",
    "confirmed"             => ":attribute konfirmasi tidak cocok.",
    "date"                  => ":attribute bukan tanggal valid.",
    "date_format"           => ":attribute tidak cocok dengan format :format.",
    "different"             => ":attribute dan :other harus berbeda.",
    "digits"                => ":attribute harus berupa :digits digit.",
    "digits_between"        => ":attribute harus di antara :min and :max digit.",
    "email"                 => ":attribute bukan berupa valid email.",
    "exists"                => "terpilih :attribute tidak valid.",
    "image"                 => ":attribute harus berupa gambar.",
    "in"                    => "selected :attribute tidak valid.",
    "integer"               => ":attribute harus berupa integer.",
    "ip"                    => ":attribute harus berupa IP address.",
    "max"                   => array(
        "numeric"           => ":attribute tidak boleh lebih dari :max.",
        "file"              => ":attribute tidak boleh lebih dari :max KB.",
        "string"            => ":attribute tidak boleh lebih dari :max karakter.",
        "array"             => ":attribute tidak boleh lebih dari :max items.",
    ),
    "mimes"                 => ":attribute harus berupa file: :values.",
    "min"                   => array(
        "numeric"           => ":attribute harus lebih dari :min.",
        "file"              => ":attribute harus lebih dari :min KB.",
        "string"            => ":attribute harus lebih dari :min karakter.",
        "array"             => ":attribute harus paling tidak :min items.",
    ),
    "not_in"                => "selected :attribute tidak valid.",
    "numeric"               => ":attribute harus berupa angka.",
    "regex"                 => ":attribute format tidak valid.",
    "required"              => ":attribute harus diisi.",
    "required_if"           => ":attribute harus diisi ketika :other adalah :value.",
    "required_with"         => ":attribute harus diisi ketika :values ada.",
    "required_with_all"     => ":attribute harus diisi ketika :values tidak ada.",
    "required_without"      => ":attribute harus diisi ketika :values tidak ada.",
    "required_without_all"  => ":attribute harus diisi ketika :values tidak ada.",
    "same"                  => ":attribute and :other harus sama.",
    "size"                  => array(
        "numeric"           => ":attribute harus :size.",
        "file"              => ":attribute harus :size KB.",
        "string"            => ":attribute harus :size karakter.",
        "array"             => ":attribute harus berisi :size items.",
    ),
    "unique"                => ":attribute sudah ada.",
    "url"                   => ":attribute format tidak valid.",
    "timezone"              => ":attribute timezone tidak valid.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(
        'attribute-name' => array(
            'rule-name' => 'custom-message',
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(),

);