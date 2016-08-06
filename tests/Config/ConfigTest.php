<?php

/**
 * Created by PhpStorm.
 * User: ediaimoborges
 * Date: 05/08/16
 * Time: 17:00
 */

use MyStuff\Config\Config;

class ConfigTest extends TestCase
{

    private $diretorio = __DIR__;

    protected function retornaArquivoMockDeTeste()
    {
        $rota = $this->diretorio .'/config.php';

        return require $rota;
    }

    public function testObtemArquivoDeConfiguracao()
    {

        $config = new Config($this->diretorio);

        $arquivoAtual = $config->get('config');

        $this->assertTrue(is_array($arquivoAtual), 'O arquivo atual não é uma array');

    }

    public function testVerificaSeExisteAlgumaConfiguracaoNoArquivo()
    {
        $config = new Config($this->diretorio);

        $arquivoAtual = $config->get('config');

        $temItemNaArray = (count($arquivoAtual) > 0);

        $this->assertTrue($temItemNaArray, 'O arquivo atual não possui configuração');
    }

    public function testVerificaSeEUmaArrayDeArray()
    {
        $config = new Config($this->diretorio);

        $arquivoAtual = $config->get('config');

        foreach($arquivoAtual as $key => $a) {

            $this->assertFalse(is_int($key), 'O arquivo atual não possui configurações nomeadas');
        }

    }


    public function testVerificaSeEArquivoMesmoElimimandoFake()
    {

        $arquivoAtual = $this->retornaArquivoMockDeTeste();

        $config = new Config($this->diretorio);

        $config = $config->get('config');

        $this->assertEquals($config['public_path'], $arquivoAtual['public_path']);

    }


    /**
     * @expectedException \MyStuff\Exception\FileConfigException
     */
    public function testArquivoDeConfiguracaoNaoExisteRetornUmaExececao()
    {

        $config = new Config($this->diretorio);

        $config->get('email');
    }

    public function testObtemConfiguracaoEspecificaDoArquivoDeConfiguracao()
    {
        $arquivoAtual = $this->retornaArquivoMockDeTeste();

        $config = new Config($this->diretorio);

        $publicPath = $config->get('config.public_path');

        $this->assertEquals($publicPath, $arquivoAtual['public_path']);
    }

    /**
     * @expectedException \MyStuff\Exception\FileConfigException
     */
    public function testErroNoCasoDePosicaoDoArrayNaoExistaNoArquivoConfiguracao()
    {

        $config = new Config($this->diretorio);

        $config->get('config.webs');
    }


    public function testObtemValorDeUmaConfiguracaoDentroDeArrayDeArray()
    {
        $arquivoAtual = $this->retornaArquivoMockDeTeste();

        $config = new Config($this->diretorio);

        $publicPath = $config->get('config.webApp.email');

        $this->assertEquals($arquivoAtual['webApp']['email'], $publicPath, 'Espero que retorne edyonil@gmail.com');
    }

    public function testObtemValorDeUmaArrayFihaQueEstaDentroDeOutraArray()
    {
        $arquivoAtual = $this->retornaArquivoMockDeTeste();

        $config = new Config($this->diretorio);

        $publicPath = $config->get('config.diretorio.folder2.imagem');

        $this->assertEquals($arquivoAtual['diretorio']['folder2']['imagem'], $publicPath, 'Espero que retorne valor2');
    }


    public function testObtemArrayDeDentroDeOutraArray()
    {
        $arquivoAtual = $this->retornaArquivoMockDeTeste();

        $config = new Config($this->diretorio);

        $publicPath = $config->get('config.diretorio.folder2');

        $this->assertEquals($arquivoAtual['diretorio']['folder2'], $publicPath, 'Espero que retorne uma array');

        $this->assertCount(count($arquivoAtual['diretorio']['folder2']), $publicPath);
    }

    /**
     * @expectedException \MyStuff\Exception\FileConfigException
     */
    public function testGeraExcecaoCasoValorDeArrayDentroDeOutraArrayInvalido()
    {

        $config = new Config($this->diretorio);

        $config->get('config.diretorio.folder3');

    }

}
