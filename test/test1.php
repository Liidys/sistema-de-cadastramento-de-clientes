<?php 

use PHPUnit\Framework\TestCase;

class TesteCliente extends TestCase{

    private $repositorioCliente;
    private $servicoCliente;

    function setUp(): void {
        $this->repositorioCliente = new RepositorioCliente();
        $this->servicoCliente = new ServicoCliente($this->repositorioCliente);
    }
    
    function test_criar_cliente() {
        $clienteTest = $this->servicoCliente->criar_cliente('João Bezerra', '15/07/2002', '101.212.596-71', 'Avenida Alameda Soltão, 245', '4002-8922', 'bezerrinhagostosao@hotmail.com');
        assertNotNull($clienteTest);
    }
    
    function test_listar_clientes(){

        $clientesInicial = $this->servicoCliente->listar_clientes();
        $clientesQuant = count($clientesInicial);

        $this->servicoCliente->criar_cliente('Naudete Lima', '15/07/2002', '101.212.596-71', 'Avenida Alameda Soltão, 245', '4002-8922', 'liminha@hotmail.com');
        $this->servicoCliente->criar_cliente('Maria Beterraba', '05/03/2012', '101.212.596-71', 'Avenida Alameda Soltão, 245', '4002-8922', 'roxinhalinda@hotmail.com');
        $this->servicoCliente->criar_cliente('Cleitinho Leitão', '15/07/2002', '101.212.596-71', 'Avenida Alameda Soltão, 245', '4002-8922', 'leitequente@gmail.com');
    
        $clientesTest = $this->servicoCliente->listar_clientes();
        assertCount($clientesQuant + 3, $clientesTest);
    }
    
    function test_editar_cliente() {
        $clienteTest = $this->servicoCliente->criar_cliente('Jotão', '15/07/2002', '110.222.596-71', 'Avenida Alameda Soltão, 245', '4002-8922', 'J@hotmail.com');
        assertNotNull($clienteTest);

        $clienteEditado = $this->servicoCliente->editar_cliente('Cleitinho Leitão', '15/08/2005', '110.222.596-71', 'Rua Catingueira da Mata, 177', '4040-1238', 'leitequente@gmail.com');
        assertNotNull($clienteEditado);
        
        $clientesLista = $this->servicoCliente->listar_clientes();
        $clienteEncontrado = null;
        foreach($clientesLista as $cliente){
            if($cliente->cpf == '110.222.596-71'){
                $clienteEncontrado = $cliente;
                break;
            }
        }

        assertNotNull($clienteEncontrado);
        assertEquals($clienteEditado, $clienteEncontrado);


    }
    
    
    function test_deletar_cliente() {
        $clienteTest = $this->servicoCliente->criar_cliente('Jotão', '15/07/2002', '101.212.596-71', 'Avenida Alameda Soltão, 245', '4002-8922', 'J@hotmail.com');
        $clientesInicial = $this->servicoCliente->listar_clientes();
        $clientesQuant = count($clientesInicial);
        assertNotNull($clientesQuant);

        $this->servicoCliente->deletar_cliente($clienteTest);
        $clientesFinal = $this->servicoCliente->listar_clientes();
        assertCount($clientesQuant - 1, $clientesFinal);


    }

}



?>