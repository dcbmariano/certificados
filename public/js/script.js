const validar = (frm)=>{
    /* 
    * Validação do formulário de submissão
    * Legado do sistema antigo
    */

    let erros = 0;
    let msg = "";    

    if(frm.nomecompleto.value === ''){
        msg += 'Campo "nome" não pode estar em branco.\n';
        erros++;
    }

    if(frm.email.value == ''){
        msg += 'Campo "email" não pode estar em branco.\n';
        erros++;
    }

    if(frm.nascimento.value == ''){
        msg += 'Campo "Data de nascimento" não pode estar em branco.\n';
        erros++;
    }

    let ano_nascimento = parseInt(frm.nascimento.value.substr(6,4));
    let ano_atual = new Date().getFullYear();

    if((ano_atual - ano_nascimento > 200)||(ano_atual - ano_nascimento < 2)){
        alert("Infelizmente não podemos emitir certificados para pessoas com idade maior do que 200 anos (ou menor do que 2).\n\nA data de nascimento é usada na recuperação de certificados. Caso você perca seu certificado, poderá emitir uma cópia informando seu e-mail e sua data de nascimento.");
        
        erros++;
    }

    if(frm.formacao.value == ''){
        msg += 'Campo "Formação acadêmica" deve ser preenchido com uma opção.\n';
        erros++;
    }

    if(erros>0){
        alert(msg);
        return false;
    }	

    else{
        alert("ATENÇÃO: \nSeu certificado será gerado pelo sistema. Não se esqueça de salvá-lo (não armazenamos certificados). Confira se seus dados estão corretos. Caso detecte algum erro, FECHE a página. Você só pode gerar um certificado por dia.\nNome: "+frm.nomecompleto.value+"\nE-mail: "+frm.email.value+"\nCurso: "+frm.curso.value+"\nALUNOS DA UDEMY: não se esqueçam de avaliar o curso e curtir a página no Facebook. Certificados emitidos a alunos que não avaliaram terão o código de validação ANULADO.\nEventualmente, podemos conferir se os dados informados conferem com dados enviados pela Udemy. Se detectada qualquer fraude, o certificado será invalidado pelo sistema. Lembre-se de que o mais importante no certificado é o código de validação.");

        frm.submit();
    }
}

const ativarTabelasInterativas = ()=>{
    /* 
    * Responsável apenas por ativar as 
    * tabelas interativas com DataTables 
    */

    $(()=>{ // document ready

        // tabelas restrito bootstrap
        $('#tabela_eventos').DataTable(
            {
                language: {
                    url: url_base+"/data/pt_br.json"
                }
            }
        );

        // tabela meus_certificados
        $('#meus_certificados').DataTable(
            {
                language: {
                    url: url_base+"/data/pt_br.json"
                }
            }
        );        

        $('#tabela_estudantes').DataTable({
            language: {
                url:url_base+"/data/pt_br.json"
            },
            processing:true,
            serverSide:true,
            responsive:true,
            "ajax":{
                'url':url_base+"/restrito/estudantesAjax",
            },
            //pageLength:25,
            columns: [
                {data:'id'}, // 0
                {data: 'nome'}, // 1
                {data: 'email'},
                {data: 'data_nascimento'}, // 3 idade
                {data: 'data_nascimento'}, //4
                {data: 'formacao'}, // 5
                {data:'created_at'}, // 6
                {data:'inscrito'}, // 7
                {data:'id'}, // editar  // 8
                {data:'id'}, // mostrar certificados // 9
                {data:'id'}, // deletar estudante // 10
            ],
            "columnDefs": [
                // AUMENTA A LARGURA DA COLUNA NOME
                {
                    "className": "w-25", "targets": [1]
                },
                { // FORMATA IDADE
                    "render":(data,type,row)=>{
                        let ano_atual = new Date().getFullYear();
                        let ano_nascimento = parseInt(data.substr(0,4));
                        return ano_atual-ano_nascimento;
                    }, "targets":3
                },
                { // FORMATA DATA DE INSCRICAO
                    "render":(data,type,row)=>{
                        return data.substr(0,10);
                    }, "targets":6
                },
                { // INSCRITO (SIM ou NAO; 1 ou 0)
                    "render": function (data, type, row) {
                        if(data==1){
                            return '<i class="bi-check-circle-fill text-success"></i>';
                        }
                        else if(data==0){
                            return '<i class="bi-x-circle-fill text-danger"></i>';
                        }
                    },
                    "targets": 7
                },
                { // BOTÃO EDITAR
                    "render":(data,type,row)=>{
                        return '<a href="#" data-bs-toggle="modal" data-bs-target="#modal_editar_estudante" data-bs-whatever="'+data+'" onclick="editarestudante('+data+')"><i class="bi-pencil-square"></i></a>';
                    }, "targets":8
                },
                { // BOTÃO LISTAR CERTIFICADOS
                    "render":(data,type,row)=>{
                        return '<a href="#" onclick="listarCertificados('+data+')" data-bs-toggle="modal" data-bs-target="#modal_listar_certificados" data-bs-whatever="'+data+'"><i class="bi bi-file-earmark-text-fill"></i></a>';
                    }, "targets":9
                }, 
                { // BOTÃO DELETAR ESTUDANTE
                    "render":(data,type,row)=>{
                        return '<a href="#" onclick="confirmarDelecaoEstudante('+data+')" data-bs-toggle="modal" data-bs-target="#modal_deletar_estudante"><i class="bi bi-x-circle-fill text-danger"></i></a>';
                    }, "targets":10
                }, 
                {"className": "dt-center", "targets": [7,8,9,10]}
            ]
        });

        
    }); // fim document ready
}
const atalhoCertificado = ()=>{

    // preenche validação de certificado
    const urlParams = new URLSearchParams(window.location.search);
    try{
        const codigo = urlParams.get('id');
        if(codigo.length == 6){
            $('[name=code1]').val(codigo[0]);
            $('[name=code2]').val(codigo[1]);
            $('[name=code3]').val(codigo[2]);
            $('[name=code4]').val(codigo[3]);
            $('[name=code5]').val(codigo[4]);
            $('[name=code6]').val(codigo[5]);
        }
    } catch{
        let warning = 'Nenhum id especificado';
    }

}

const ativarModais = ()=>{

    // modal editar
    var modal_editar = document.getElementById('modal_editar')

    modal_editar.addEventListener('show.bs.modal', function (event) {

        var button = event.relatedTarget

        var recipient = button.getAttribute('data-bs-whatever')

        // AJAX AQUI

        var modalTitle = modal_editar.querySelector('.modal-title')
        var modalBodyInput = modal_editar.querySelector('.modal-body input')

        modalTitle.textContent = 'Editando usuário ID #' + recipient
        modalBodyInput.value = recipient

    }) 

    // modal listar certificados

    // var modal_listar_certificados = document.getElementById('modal_listar_certificados')

    // modal_listar_certificados.addEventListener('show.bs.modal', function (event) {

    //     var button = event.relatedTarget

    //     var recipient = button.getAttribute('data-bs-whatever')

    //     // AJAX AQUI

    //     var modalTitle = modal_listar_certificados.querySelector('.modal-title')
    //     var modalBodyInput = modal_listar_certificados.querySelector('.modal-body input')

    //     modalTitle.textContent = 'Editando usuário ID #' + recipient
    //     modalBodyInput.value = recipient

    // }) 
}

var tabela = $().DataTable(); 

// ESTA FUNÇÃO PERMITE ATUALIZAR A LISTA DE CERTIFICADOS DO ESTUDANTE ATUAL
const listarCertificados = (id) =>{
    

    // destrua a tabela anterior
    tabela.destroy();

    // limpe o elemento html
    $("#certificados_estudante").empty()
    
    // $("#certificados_estudante thead").innerHtml("<tr>aaaa</tr>")

    // Preenche a tabela interativa restrito/certificados do autor
    tabela = $('#certificados_estudante').DataTable(
        {
            language: {
                url:url_base+"/data/pt_br.json"
            },
            processing:true,
            serverSide:true,
            responsive:true,
            "ajax":{
                'url':url_base+"/restrito/listarCertificadosAjax/"+id,
            },
            columns: [
                {data:'id_certificado'}, // 0
                {data: 'nome_estudante'}, // 1
                {data: 'id_usuario'}, // 2
                {data: 'email'},
                {data: 'nome_curso'}, // 4
                {data: 'codigo_curso'}, // 5
                {data:'data_emissao'}, // 6
                {data:'id_certificado'}, // gerar pdf // 7
            ],
            "columnDefs": [
                {
                    title:"#", targets:0
                },   {
                    title:"Nome", targets:1
                },      {
                    title:"id_usuario", targets:2
                },      {
                    title:"E-mail", targets:3
                },      {
                    title:"Curso", targets:4
                },      {
                    title:"id_curso", targets:5
                },           {
                    title:"Emissão", targets:6
                },                {
                    title:"Gerar certificado", targets:7
                },                   
                { // BOTÃO DOWNLOAD
                    "render":(data,type,row)=>{
                        return '<a class="btn btn-outline-success" href="'+url_base+'/?id='+data+'">Download</a>';
                    }, "targets":7
                },                
                {"className": "dt-center", "targets": [7]}
            ]
        });
        
    $("#certificados_estudante thead th").text("a")
}

// MAIN ------------------------------------------
// -----------------------------------------------

$(()=>{
    
    $("[name=code1]").focus();

    // pula para o próximo campo (keycode==8 => backspace)
    $("[name=code1]").on('keyup',(e)=>{ if(e.keyCode!=8 ){$("[name=code2]").focus() }});
    $("[name=code2]").on('keyup',()=>{ $("[name=code3]").focus() });
    $("[name=code3]").on('keyup',()=>{ $("[name=code4]").focus() });
    $("[name=code4]").on('keyup',()=>{ $("[name=code5]").focus() });
    $("[name=code5]").on('keyup',()=>{ $("[name=code6]").focus() });
    
    // ao apagar, volta para campo anterior
    $("[name=code6]").on('keyup', (e)=>{ if(e.keyCode==8){ $("[name=code5]").focus() }}); 
    $("[name=code5]").on('keyup', (e)=>{ if(e.keyCode==8){ $("[name=code4]").focus() }}); 
    $("[name=code4]").on('keyup', (e)=>{ if(e.keyCode==8){ $("[name=code3]").focus() }}); 
    $("[name=code3]").on('keyup', (e)=>{ if(e.keyCode==8){ $("[name=code2]").focus() }}); 
    $("[name=code2]").on('keyup', (e)=>{ if(e.keyCode==8){ $("[name=code1]").focus() }}); 


    let data = $('.formatarData').text();
    data = data.substr(8, 2) + "/" + data.substr(5, 2) + "/" + data.substr(0, 4);
    $('.formatarData').text(data);

    // ATIVA TODOS OS TOOLTIP
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
    })



});