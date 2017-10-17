<?php


namespace OCFram;


class Config extends ApplicationComponent {

    // XmlConfigTrait - get() method comes from this trait. It is XML specific so should config be
    // obtained from a different type of doc in the future it is just a case of creating a different trait which
    // establishes the get() then using that trait instead of this one.
    use XmlConfigTrait;

    protected $vars = [];

}