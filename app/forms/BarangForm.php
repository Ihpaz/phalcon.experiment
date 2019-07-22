<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Forms\Element\Select;


class BarangForm extends Form
{
    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = [])
    {
        // if (!isset($options['edit'])) {
        //     $element = new Text("id");
        //     $this->add($element->setLabel("Id"));
        // } else {
        //     $this->add(new Hidden("id"));
        // }

        $barcode = new Text("kodebarcode");
        $barcode->setLabel("Kode Barcode");
        $barcode->setFilters(['striptags', 'string']);
        $barcode->addValidators([
            new PresenceOf([
                'message' => 'Kode Barcode is required'
            ])
        ]);
        $this->add($barcode);

        $namabarang = new Text("namabarang");
        $namabarang->setLabel("Nama Barang");
        $namabarang->setFilters(['striptags', 'string']);
        $namabarang->addValidators([
            new PresenceOf([
                'message' => 'Nama Barang is required'
            ])
        ]);
        $this->add($namabarang);

        $satuan = new Select(
            'satuan',
            [
                'UNIT' => 'UNIT',
                'PCS' => 'PCS',
                'KG' => 'KG',
            ]);
        $satuan->setLabel("Satuan");
        $satuan->setFilters(['striptags', 'string']);
        $satuan->addValidators([
            new PresenceOf([
                'message' => 'Satuan is required'
            ])
        ]);
        $this->add($satuan);

        $harga = new Numeric("harga");
        $harga->setLabel("Harga");
        $harga->setFilters(['striptags', 'int']);
        $harga->addValidators([
            new PresenceOf([
                'message' => 'Harga is required'
            ])
        ]);
        $this->add($harga);
    }
}
