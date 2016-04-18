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

    "accepted"              => "isian :attribute harus disetujui.",
    "active_url"            => "isian :attribute bukan valid URL.",
    "after"                 => "isian :attribute harus berupa tanggal setelah :date.",
    "alpha"                 => "isian :attribute hanya boleh berupa kata.",
    "alpha_dash"            => "isian :attribute hanya boleh berupa kata, nomor, and penghubung.",
    "alpha_num"             => "isian :attribute hanya boleh berupa kata and nomor.",
    "array"                 => "isian :attribute harus berupa array.",
    "before"                => "isian :attribute harus berupa tanggal sebelum :date.",
    "between"               => array(
        "numeric"           => "isian :attribute harus diantara :min - :max.",
        "file"              => "isian :attribute harus diantara :min - :max KB.",
        "string"            => "isian :attribute harus diantara :min - :max karakter.",
        "array"             => "isian :attribute harus diantara :min and :max items.",
    ),
    "boolean"               => "isian :attribute harus berupa true atau false",
    "confirmed"             => "isian :attribute konfirmasi tidak cocok.",
    "date"                  => "isian :attribute bukan tanggal valid.",
    "date_format"           => "isian :attribute tidak cocok dengan format :format.",
    "different"             => "isian :attribute dan :other harus berbeda.",
    "digits"                => "isian :attribute harus berupa :digits digit.",
    "digits_between"        => "isian :attribute harus di antara :min and :max digit.",
    "email"                 => "isian :attribute bukan berupa valid email.",
    "exists"                => "terpilih isian :attribute tidak valid.",
    "image"                 => "isian :attribute harus berupa gambar.",
    "in"                    => "selected isian :attribute tidak valid.",
    "integer"               => "isian :attribute harus berupa integer.",
    "ip"                    => "isian :attribute harus berupa IP address.",
    "max"                   => array(
        "numeric"           => "isian :attribute tidak boleh lebih dari :max.",
        "file"              => "isian :attribute tidak boleh lebih dari :max KB.",
        "string"            => "isian :attribute tidak boleh lebih dari :max karakter.",
        "array"             => "isian :attribute tidak boleh lebih dari :max items.",
    ),
    "mimes"                 => "isian :attribute harus berupa file: :values.",
    "min"                   => array(
        "numeric"           => "isian :attribute harus lebih dari :min.",
        "file"              => "isian :attribute harus lebih dari :min KB.",
        "string"            => "isian :attribute harus lebih dari :min karakter.",
        "array"             => "isian :attribute harus paling tidak :min items.",
    ),
    "not_in"                => "selected isian :attribute tidak valid.",
    "numeric"               => "isian :attribute harus berupa angka.",
    "regex"                 => "isian :attribute format tidak valid.",
    "required"              => "isian :attribute harus diisi.",
    "required_if"           => "isian :attribute harus diisi ketika :other adalah :value.",
    "required_with"         => "isian :attribute harus diisi ketika :values ada.",
    "required_with_all"     => "isian :attribute harus diisi ketika :values tidak ada.",
    "required_without"      => "isian :attribute harus diisi ketika :values tidak ada.",
    "required_without_all"  => "isian :attribute harus diisi ketika :values tidak ada.",
    "same"                  => "isian :attribute tidak sama dengan :other.",
    "size"                  => array(
        "numeric"           => "isian :attribute harus :size.",
        "file"              => "isian :attribute harus :size KB.",
        "string"            => "isian :attribute harus :size karakter.",
        "array"             => "isian :attribute harus berisi :size items.",
    ),
    "unique"                => "isian :attribute sudah ada.",
    "url"                   => "isian :attribute format tidak valid.",
    "timezone"              => "isian :attribute timezone tidak valid.",

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

    'attributes' => require(__DIR__.'/livecms.php'),

);
