<?php

namespace Tests\Unit;

use App\Imports\SpeciesImport;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertArrayHasKey;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

class ExcelImportPreparationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_latin_name_is_correctly_extracted()
    {
      $spi = new SpeciesImport;
      $row = $spi->prepareForValidation(['ladinakeelne_nimi'=>"x"], 0);  
      assertArrayHasKey('latin_name', $row);
      assertEquals('x', $row['latin_name']);

      $row = $spi->prepareForValidation(['ladina_keelne_nimi'=>"x"], 0);  
      assertArrayHasKey('latin_name', $row);
      assertNull($row['latin_name']);
    }
}
