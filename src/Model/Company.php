<?php

namespace App\Model;

class Company extends Entity
{
    private string $name = '';
    private string $date = '';
    private string $vat = '';

    public function validate()
    {
        $this->__checkVat($this->vat);
        // alte validari ar fi putut fi adaugate aici..
    }

    /**
     * @param string $vat
     * @link https://vatlayer.com/quickstart
     */
    private function __checkVat(string $vat)
    {
        $vat = json_decode(
            file_get_contents(
                "http://www.apilayer.net/api/validate?access_key=935108948f5baae2f6937dd57c8431a6&vat_number=$vat&format=1"
            )
        );
        if (!empty($vat->error)) {
            $this->errors['vat'] = $vat->error->info;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getVat(): string
    {
        return $this->vat;
    }

    /**
     * @param string $vat
     */
    public function setVat(string $vat): void
    {
        $this->vat = $vat;
    }
}