<?php
// 2025-10-10 16:31:34

$GLOBAL_VAR___info_erros__versao_lib = "alpha 0.001 2025-09-08 14:07:33";

// variavel para saber se os handler já foram definidos não sejam definidos novamentes
$GLOBAL_VAR___info_erros__habilitado = false;
$GLOBAL_VAR___info_erros__pararNoPrimeiroErro = false;


/* ================================================================================ */

/**
 * Retona a versão deste pacote de funções.
 * Apenas para saber a versão e identificar se esta usando uma versão desatualizada.
 */
function _info_erros__versao()
{
    global $GLOBAL_VAR___info_erros__versao_lib;

    return $GLOBAL_VAR___info_erros__versao_lib;
}

$GLOBAL_VAR___MEU_DEBUG = null;

/* ====================================================================== */
class MeuDebug
{
    private bool $ativo = false;
    private bool $cfgLogNaPagina = false;
    private bool $cfgDumpArquivoLog = false;

    // private string $style_div_hover = "";
    private string $style_div_hover =  "box-sizing: border-box; position: fixed; z-index: 99999; top: 0; bottom: 0; left: 0; right: 0; padding: 2rem 2rem; background-color: rgba(255,255,255,0.8);";
    private string $style_div_message = "box-sizing: border-box; background-color: #f8d7da; border: 4px solid #f5c6cb; margin:0;  padding: 10px; color: #721c24; border-radius: 5px; white-space: pre-wrap; word-wrap: break-word; overflow-wrap: break-word; max-height: 100%; max-width: 100%;  overflow: auto; ";

    public function estaAtivo()
    {
        global $GLOBAL_VAR___info_erros__habilitado;
        // return $this->ativo;
        return $GLOBAL_VAR___info_erros__habilitado;
    }

    /**
     * Habilita a captura de erro e despejo na pagina em destaque com informações a respeito do erro.
     */
    public function cfgAtivarDespejoNaPagina(bool $pararNoPrimeiroErro = false)
    {
        global $GLOBAL_VAR___info_erros__habilitado;
        global $GLOBAL_VAR___info_erros__pararNoPrimeiroErro;

        $GLOBAL_VAR___info_erros__pararNoPrimeiroErro = $pararNoPrimeiroErro;

        if ($GLOBAL_VAR___info_erros__habilitado == false) {
            $GLOBAL_VAR___info_erros__habilitado = true;

            // Ativar a exibição de erros
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            // Definir um manipulador de erros personalizado
            // set_error_handler("_info_erros__error_handler");
            set_error_handler(function ($errno, $errstr, $errfile, $errline) {
                global $GLOBAL_VAR___info_erros__pararNoPrimeiroErro;

                // Exibir os erros dentro de uma div
                echo '<div style="' . $this->style_div_hover . '">';
                echo '<div style="' . $this->style_div_message . '">';

                // tenta apresentar qual foi o tipo do erro
                switch ($errno) {
                    case E_WARNING:
                        echo "<strong>⚠️ Warning:</strong>";
                        break;
                    case E_NOTICE:
                        echo "<strong>ℹ️ Notice:</strong>";
                        break;
                    case E_USER_ERROR:
                    case E_ERROR:
                        echo "<strong>🧨 Error:</strong>";
                        break;
                    case E_DEPRECATED:
                        echo "<strong>📛 Deprecated:</strong>";
                        break;
                    default:
                        echo "<strong>Erro [$errno]:</strong>";
                }

                echo " $errstr <br><br>";
                echo "<strong>Arquivo:</strong><br>$errfile <strong>Linha:</strong> $errline <br>";
                // echo "<strong>X:</strong> $x <br>";
                echo '</div>';
                echo '</div>';

                if ($GLOBAL_VAR___info_erros__pararNoPrimeiroErro == true) {
                    die();
                }
            });

            // habilita a captura de exceções com despejo na tela
            set_exception_handler(function ($exception) {
                __meuDebug()->print_detalhesDoErroCatch($exception);
            });
        }
    }

    // public function cfgDesativarDespejoNaPagina()
    // {
    //     restore_error_handler();
    // }

    /**
     * Habilita o despejo de erros em um arquivo para visualizar se erros estão ocorrendo e não esta sendo possivel mapea-los de alguma forma.
     */
    public function cfgPhpAtivarErrosEmArquivoLog($apagarArquivoLogAnterior = true)
    {
        $arquivoLog =  __DIR__ . '/erros_php.log';

        // apaga o arquivo anterior se a opçao estiver ativa
        if ($apagarArquivoLogAnterior && file_exists($arquivoLog)) {
            unlink($arquivoLog);
        }

        // para salvar os erros em um arquivo
        ini_set('log_errors', 1);
        ini_set('error_log', $arquivoLog);
    }

    private function extrairDadosException($erro)
    {

        $reflexao = new ReflectionClass($erro);
        $dados = [];

        foreach ($reflexao->getProperties() as $propriedade) {
            $propriedade->setAccessible(true);
            $dados[$propriedade->getName()] = $propriedade->getValue($erro);
        }

        return $dados;
    }

    public function print_detalhesDoErroCatch($excecao, $extra_info = null)
    {
        function echo_pre(string $titulo = "", string $pre = "")
        {
            echo "<div style='color: #000000;  padding: 2px 3px 2px 3px; font-weight: bold; ' >" . htmlspecialchars($titulo) . "</div>";
            echo "<pre style='white-space: pre-wrap; word-wrap: break-word; padding: 0px 3px 2px 3px; font-weight: bold; margin: 0; margin-bottom: 10px;' >" . $pre . "</pre>";
        }

        global $GLOBAL_VAR___info_erros__habilitado;

        if ($GLOBAL_VAR___info_erros__habilitado) {



            $dados = $this->extrairDadosException($excecao);

            echo '<div style="' . $this->style_div_hover . '">';
            // echo '<div style="padding: 0px 0px 20px 0px;">';
            echo '<div style="' . $this->style_div_message . '">';

            // echo_pre("Exceção não tratada:", $excecao->getMessage());


            // $saida = json_encode($dados, JSON_PRETTY_PRINT);
            // echo_pre("=== ✴️ Detalhes da Exception (v: " . _info_erros__versao() . ") ===", $saida);
            echo_pre("=== ✴️ Detalhes da Exception (v: " . _info_erros__versao() . ") ===", "");
            echo_pre("=== Classe da Exceção ===", get_class($excecao));
            echo_pre("=== Mensagem da Exceção ===", $excecao->getMessage());
            echo_pre("Arquivo: ", $excecao->getFile() . " Linha: " .  $excecao->getLine());
            // echo_pre("=== Stack Trace (pilha de execução) ===", $excecao->getTraceAsString());


            echo_pre("=== Stack Trace (pilha de execução) ===");

            // $saida_stack = "";
            foreach ($excecao->getTrace() as $n => $arr_stack) {


                $saida_stack = "";
                // $saida_stack .= json_encode($arr_stack, JSON_PRETTY_PRINT) . "\n";
                foreach ($arr_stack as $key => $value) {
                    $saida_stack .= "$key:  " . json_encode($value, JSON_PRETTY_PRINT) . "\n";
                    // echo "$key:  $value\n";
                }
                // $saida_stack .= "\n";

                echo_pre("-- $n --", $saida_stack);
            }


            // echo_pre("=== Stack Trace (pilha de execução) ===", $saida_stack);
            // echo_pre("=== Stack Trace (pilha de execução) ===", json_encode($excecao->getTrace(), JSON_PRETTY_PRINT));

            // foreach ($excecao->getTrace() as $n => $arr_stack) {
            //     echo "-- $n --\n";
            //     echo json_encode($arr_stack, JSON_PRETTY_PRINT);
            //     // foreach ($arr_stack as $key => $value) {
            //     //     echo "$key:  $value\n";
            //     // }
            // }

            // echo "<pre>";
            // var_dump($excecao->getTrace());
            // echo "</pre>";


            // if ($erro instanceof MinhaExcecaoBancoDados) {

            // }


            if ($extra_info) {
                echo_pre("=== Informação Extra ===", json_encode($extra_info, JSON_PRETTY_PRINT));
            }

            echo '</div>';

            // echo "<pre>";
            // var_dump($excecao);
            // echo "</pre>";

            echo '</div>';
            // echo '</div>';
        }
    }

    protected function  echo_header()
    {
        echo '<div style="' . $this->style_div_hover . '">';
        echo '<div style="' . $this->style_div_message . '">';
    }

    protected function  echo_footer()
    {
        echo '</div></div>';
    }

    public function var_dump($variavel)
    {
        $this->echo_header();
        echo "<pre>";
        var_dump($variavel);
        echo "</pre>";
        $this->echo_footer();
        exit();
    }
}

/**
 * Retorna ou cria um AJUDANTE de acesso ao DEBUG
 * @return MeuDebug
 */
function __meuDebug(): MeuDebug
{
    global $GLOBAL_VAR___MEU_DEBUG;

    if ($GLOBAL_VAR___MEU_DEBUG == null) {
        $GLOBAL_VAR___MEU_DEBUG = new MeuDebug();
    }
    return $GLOBAL_VAR___MEU_DEBUG;
}

// verifcando se esta rodando localmente
function rodandoLocalmente()
{
    $whitelist = ['127.0.0.1', '::1', 'localhost'];

    $remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '';
    $host = $_SERVER['HTTP_HOST'] ?? '';

    return in_array($remoteAddr, $whitelist) || in_array($host, $whitelist);
}

// ativando o debug ao incluir o arquivo
if (rodandoLocalmente()) {
    __meuDebug()->cfgAtivarDespejoNaPagina(true);
}
