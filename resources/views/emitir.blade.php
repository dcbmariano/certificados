@extends('template')
@section('titulo', 'Certificados')

@section('conteudo')

<div id="content" style="padding:0">

    <div class="formacao bg-secondary text-light py-5" >
        <span class="destaque"><strong style="color:#5fcac1">EMISSÃO DE CERTIFICADOS</strong></span>
        <h2 class="pt-2"><strong>{{$evento->nome}}</strong></h2>
        <span class="destaque">_____</span>
    </div>

    <div class="bg-white mb-4 pt-5 pb-4 mx-0">
        <div class="container">
            <h4><strong>Parabéns! Você concluiu o curso "{{$evento->nome}}" com sucesso!</strong></h4>
            <p class="text-muted"><strong>Preencha os dados a seguir</strong> para que possamos emitir seu certificado. Confira os valores preenchidos duas vezes antes de clicar no botão "Emitir Certificado". Será gerado um arquivo no formato PDF com os exatos valores inseridos nos campos abaixo. Salve o arquivo ou imprima (se desejado). Não é obrigatório validar ou verificar.</p>
        </div>
    </div>

<form method="post" action="/gerar/pdf" onsubmit="validar(this); return false;">
    @csrf
    <input type="hidden" name="chave_de_seguranca" value="<?php echo base64_encode(strtoupper($evento->codigo_evento));  ?>">
    
    <div class="my-5">
        <div class="container">
            <label class="label label-primary"><span class="badge btn-success">1</span><span class="badge btn-dark">Nome completo:</span></label>
             <input type="text" class="form-control form-control-lg" name="nomecompleto" placeholder="Insira como gostaria que seu nome aparecesse no certificado">
        </div>
    </div>

    <div class="bg-white my-4 py-5 mx-0">
        <div class="container">
            <label class="label label-primary"><span class="badge btn-success">2</span><span class="badge btn-dark">E-mail:</span></label>
            <input type="email" class="form-control form-control-lg" name="email" placeholder="Digite seu endereço de e-mail">

        </div>
    </div>

    <div class="my-4 pt-4 pb-4 mx-0">
        <div class="container">

            <label class="label label-primary"><span class="badge btn-success">3</span><span class="badge btn-dark">Data de nascimento:</span></label>
            <input type="text" class="form-control form-control-lg data" name="nascimento" placeholder="Digite apenas os números">

        </div>
    </div>

    <div class="bg-white my-4 py-5 mx-0">
        <div class="container">

            <label class="label label-primary"><span class="badge btn-success">4</span><span class="badge btn-dark">Formação acadêmica (em curso ou concluído):</span></label><br>

            <input style="margin:10px" type="radio" name="formacao" value="Ensino fundamental">Ensino fundamental

            <input style="margin:10px" type="radio" name="formacao" value="Ensino medio">Ensino médio

            <input style="margin:10px" type="radio" name="formacao" value="Ensino superior">Ensino superior

            <input style="margin:10px" type="radio" name="formacao" value="Mestrado">Mestrado

            <input style="margin:10px" type="radio" name="formacao" value="Doutorado">Doutorado

            <input style="margin:10px" type="radio" name="formacao" value="Pos-doutorado">Pós-doutorado

        </div>
    </div>

    <div class="mt-4 mb-3 mx-0 py-2">
        <div class="container">
            <label class="label label-primary"><span class="badge btn-success">5</span><span class="badge btn-dark">Dá um joinha para o  "Prof. Diego Mariano" nas redes sociais</span><span class="badge btn-danger">Opcional, mas importante xD</span></label>

    <table class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th><span class="badge btn-info">A</span> Twitter</th>
                <th><span class="badge btn-danger">B</span> Youtube</th>
                <th><span class="badge btn-secondary">C</span> LinkedIn</th>
                <th><span class="badge btn-warning">D</span> Instagram</th>                
                <th><span class="badge btn-primary">E</span> Facebook</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href="https://twitter.com/dcbmariano?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @DiiegoMariano</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </td>
                <td>
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <div class="g-ytsubscribe" data-channel="dcbmariano" data-layout="full" data-count="default"></div>
                </td>
                <td>
                    <script src="https://platform.linkedin.com/in.js" type="text/javascript"> lang: pt_BR</script>
                    <script type="IN/FollowCompany" data-id="35716694" data-counter="bottom"></script>
                </td>
                <td><a href="https://www.instagram.com/prof.diegomariano/" target="_blank"><img src="img/instagram.png" width="50px"></a>
                </td>
                <td>
                    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofessordiegomariano%2F&width=450&layout=standard&action=like&size=large&show_faces=true&share=true&height=80&appId=1113800731992155" width="450" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    </div>

    <div class="bg-white my-4 py-5 mx-0">
        <div class="container">
            <label class="label label-primary"><span class="badge btn-success">6</span><span class="badge btn-dark">Prove que você não é um robô clicando na caixa abaixo:</label>

            <div class="g-recaptcha" data-sitekey="6LeWlqUUAAAAAOQJFx-p0Tl54GGL6VvtAhdbEEv-"></div>

            </div>
    </div>

    <div class="my-5 mx-0">
        <div class="container">
            <label class="label label-primary"><span class="badge btn-success">7</span><span class="badge btn-dark">Concorde com os termos de uso:</span></label><br>

            <p class="small text-muted pt-1"><input type="checkbox" id="termos" name="termos"> Eu li e concordo com os <a href="#" data-bs-toggle="modal" data-bs-target="#termosuso">termos de uso e políticas de privacidade</a> deste site, incluindo: (1) não irei compartilhar o link desta página de geração de certificados com outras pessoas; e (2) não irei gerar certificados para cursos que não completei. Detectada uma eventual fraude, os certificados serão invalidados.</p>
            </div>
    </div>
    
    <div class="container">
        <input type="submit" id="enviar" name="submit" class="btn btn-primary btn-lg col-md-12 my-4" disabled value="Emitir certificado">
        <script>
            $("#termos").click(()=>{
                $('#termos').prop("checked", true); 
                $('#enviar').prop("disabled", false); 
            });

        </script>
    </div>

</form>

</div>


   
<div class="bg-light py-5 mt-5">

    <div class="container">
        <div class="col-md-6 col-12 offset-md-3">
            <div class="formacao">
                <span class="destaque">SOBRE</span>
                <h2><b>Quem valida este certificado?</b></h2>
                <span class="destaque">_____</span>
            </div>

            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                    <a href="#">
                    <img src="/img/alfa.jpg" width="160px" class="img-thumbnail">
                    </a>
                </div>

                <div class="flex-grow-1 ms-3">
                    <h4 class="pt-3 destaque"><b>Alfahelix</b></h4>

                    <p class="small text-muted">Somos uma <b>escola de computação</b> com profissionais altamente qualificados. Promovemos cursos rápidos, práticos e de alta qualidade. Nossos profissionais possuem graduação, mestrado ou doutorado. CNPJ: 37.524.984/0001-10</p>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="termosuso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Termos de uso e política de privacidade</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <p>

        <a href="http://www.freepik.com">Certificate designed by raftel / Freepik</a><br>

        Todos os dados enviados serão protegidos em nossas bases de dados e não são compatilhados com empresas terceiras. Dados referentes a informações vinculadas ao Facebook são regidas pelos termos de uso do <a href="facebook.com">Facebook</a>. Dados referentes a plataforma <a href="http://udemy.com">Udemy</a> também são regidos pelos termos de uso da plataforma. O mesmo é válido para outras aplicações de terceiros utilizadas por este site. <br><br>

        Certificados gerados pelo sistema são armazenados <b>temporariamente</b> em nossas servidores. Cabe ao usuário a resposabilidade de salvá-los. A Alfahelix apenas armazena metadados, como códigos de segurança, nome do usuário, data de conclusão, carga horária, dentre outros. Armazenamos ainda endereço de e-mail e data de nascimento, que são usados para recuperação de informações de usuários que desejam reemitir seus certificados. 

        <br><br>

        Ao usar nosso sistema, o usuário se compromete a não compartilhar o link deste certificado e não gerar certificados para cursos que não frequentou. O sistema fará validações eventuais para detecção de fraude. Caso seja detectada uma fraude, o certificado será cancelado e o usuário será banido e não poderá fazer cursos ou gerar certificados por este site.

        <br><br>

        Todas as informações pessoais de membros, assinantes, clientes ou visitantes que usem este site respeitam as normas brasileiras e estão em concordância com a  Lei Geral de Proteção de Dados Pessoais (LGPD), Lei nº 13.709, de 14 de agosto de 2018. Além disso, segue as normas da Lei da Proteção de Dados Pessoais de 26 de outubro de 1998 (Lei n.º 67/98) e de acordo com o  REGULAMENTO (UE) 2016/679 DO PARLAMENTO EUROPEU E DO CONSELHO de 27 de abril de 2016 relativo à proteção das pessoas singulares no que diz respeito ao tratamento de dados pessoais e à livre circulação desses dados e que revoga a Diretiva 95/46/CE (Regulamento Geral sobre a Proteção de Dados). 

        <br><br>

        A informação pessoal recolhida pode incluir o seu nome, e-mail, data de nascimento ou outros dados se necessários para a prestação de um serviço específico.

        <br><br>

        <p>Alfahelix usa cookies para personalizar sua experiência. </p>

        O uso de qualquer serviço dos sites https://diegomariano.com ou https://alfahelix.com.br pressupõe a aceitação destes termos de uso e política de privacidade. Alfahelix e Diego Mariano reservam-se ao direito de alterar este acordo sem aviso prévio. 

        <br><br>

        QUANDO INFORMAÇÃO SÃO COLETADAS?<br>

        Quando o usário as envia diretamente ao sistema através de formulários, como por exemplo, na requisição de certificados.

        <br><br>

        QUE INFORMAÇÃO E COMO COLETAMOS?<br>

        Este website recolhe informação pessoal e não-pessoal dos utilizadores. A informação pessoal que recolhemos pode incluir o nome, o e-mail, data de nascimento e escolaridade. Informação não-pessoal pode ser sobre o equipamento usado pelo utilizador para acessar o site http://diegomariano.com, como IP address, geolocalização, identificador único de equipamento, tipo de browser, língua do browser ou outra informação desta natureza. Usamos esta informação de uma forma agregada para analisar os acessos ao site. Nunca divulgamos dados sobre a utilização do site por um IP address individual.

        <br><br>

        PARA QUE SERVE A INFORMAÇÃO QUE COLETAMOS?<br>

        Informações pessoais recolhidas serão usadas para ajudar a agilizar o processo criação de conteúdos digitais e cursos relevantes para você. Os dados recolhidos têm como finalidades: gestão das permissões para efeitos de envio de comunicações de divulgação via e-mail; gestão de registos; gestão inscrições em cursos e eventos online; gestão de preferências; possíveis ações de divulgação.

        <br><br>

        LINKS PARA SITES TERCEIROS<br>
        Não nos responsabilizamos pela política de privacidade ou conteúdo presente em sites de terceiros, mesmo que tenham sido acessados por links contidos nesta página.

        <br><br>

        SUBSCRIÇÃO DA NEWSLETTER E COMPARTILHAMENTO DE INFORMAÇÃO PESSOAL<br>
        A nossa política de envio de e-mails não nos permite compartilhar, vender, trocar ou autorizar que outras entidades possam usar qualquer informação pessoal dos nossos utilizadores/participantes para fins comerciais. Ao introduzir o seu nome e e-mail no formulário de subscrição neste site você estará dando a sua permissão para que compartilhemos essa informação apenas para uso interno (gestão e colaboradores da Alfahelix). 
        <br><br>
        OS SEUS DIREITOS<br>

        Enquanto titulares dos dados pessoais, é garantido, a qualquer momento, o direito de acesso, retificação, atualização, limitação e deleção dos seus dados pessoais.

        <br><br>

        Direito a cancelar comunicações de marketing<br>

        Pode exercer o seu direito a cancelar comunicações de marketing do site contatando a Alfahelix (ver página de contato).

        <br><br>

        Acesso e retificação<br>

        Você tem o direito de pedir o acesso aos seus dados pessoais. Para isso, entre em contato através de um dos canais de atendimento.

        <br>
        Os termos aqui regidos foram inspirados no website http://adriano-ostoyke.com.
        <br><br>
        Atenciosamente, 
        Alfahelix Treinamentos
        <br>
        Lagoa Santa, 29 de maio de 2018.
        Atualizado em 6 de fevereiro de 2022.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<!-- Termos de uso -->



<script src="/js/mask.js"></script>

<script>
    // cria mascara para emissão de certificados
    $(()=>{ 
        $("input.data").mask("99/99/9999");
    });
</script>
@endsection
