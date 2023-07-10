<?php
$test = true;
session_start();
$fixed = [
  "site" => "www.copiporto.com.br",
  "endereco" => "Porto do Itaqui, São Luís - MA",
  "facebook" => "https://www.facebook.com/copiporto",
  "linkedin" => "https://www.linkedin.com/company/companhia-operadora-portuaria-do-itaqui",
  "instagram" => "https://www.instagram.com/copiporto/",
  "contato_seguro" => "https://www.contatoseguro.com.br/",
  "mensagem" => "<b>AVISO LEGAL:</b> Esta mensagem, incluindo seus anexos, &eacute; destinada exclusivamente para a(s) pessoa(s) a quem &eacute; dirigida, podendo conter informa&ccedil;&atilde;o confidencial e/ou privilegiada. Se voc&ecirc; n&atilde;o for destinat&aacute;rio desta mensagem, desde já fica notificado de abster-se de utilizar a informa&ccedil;&atilde;o contida nesta mensagem de qualquer forma, sujeitando o infrator às penas da lei; notificar o remetente e eliminar o seu conteúdo de forma definitiva. Informa&ccedil;&otilde;es transmitidas por e-mail podem ser alteradas por terceiros, n&atilde;o havendo garantia de que sua integridade foi mantida e que esteja livre de v&iacute;rus, intercepta&ccedil;&atilde;o ou interfer&ecirc;ncia, n&atilde;o podendo ser imputada qualquer responsabilidade à COPI com rela&ccedil;&atilde;o ao seu conte&uacute;do;"
];
if( $test === true ) {
  $_SESSION = [
    "usuario" => "OK",
    "nome" => "Jo&atilde;o Roberto Concei&ccedil;&atilde;o da Silva",
    "funcao" => "Coordenador Corporativo TI",
    "email" => "joao.silva@e-copi.com.br" 
  ];
  $_POST["gerarAssinatura"] = true;
}

session_regenerate_id(true);

if(!isset($_SESSION['usuario'])){
    header('Location: index.php');
    exit;
}

if(isset($_POST['gerarAssinatura'])){
  header("Content-type: text/html; charset=utf-8");
  header('Content-Disposition: attachment; filename="assinatura_'.str_replace(" ","_", $_SESSION['nome']).'.html"');
  $template = file_get_contents("template.html");
  //copilogo-link (copi.png) or base64
  //certificacao-link (certificao.png) or base64
  //Todos os base64 podem ser substituidos por links

  $template = sprintf( $template, 
  "data:image/png;base64,".base64_encode(file_get_contents("copi.png")), 
  "data:image/png;base64,".base64_encode(file_get_contents("certificacao.png")), 
  $_SESSION["nome"], 
  $_SESSION["funcao"],
  $_SESSION["email"],
  $fixed["facebook"],
  "data:image/png;base64,".base64_encode(file_get_contents("facebook.png")),
  $fixed["linkedin"],
  "data:image/png;base64,".base64_encode(file_get_contents("linkedin.png")), 
  $fixed["instagram"],
  "data:image/png;base64,".base64_encode(file_get_contents("instagram.png")), 
  $fixed["contato_seguro"],
  "data:image/png;base64,".base64_encode(file_get_contents("contato_seguro.png")), 
  $fixed["mensagem"],
  );
  echo $template;
}
else
{
	header('Location: logout.php');
}