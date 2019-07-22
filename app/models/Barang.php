<?php

use Phalcon\Mvc\Model;

class Barang extends Model
{
    /**
     * @var integer
     */
    public $Id;

    /**
     * @var string
     */
    public $kodebarcode;

    /**
     * @var string
     */
    public $namabarang;

    /**
     * @var string
     */
    public $satuan;

    /**
     * @var integer
     */
    public $harga;

    public function getSource()
    {
        return 'barang';
    }
}
