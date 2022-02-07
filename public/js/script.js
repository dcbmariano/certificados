function validar(frm){

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

    if(ano_atual - ano_nascimento > 200){
        alert("Infelizmente não podemos emitir certificados para pessoas com idade maior do que 200 anos.\n\nA data de nascimento é usada na recuperação de certificados. Caso você perca seu certificado, poderá emitir uma cópia informando seu e-mail e sua data de nascimento.");
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
    $(()=>{ // document ready

        // tabelas restrito bootstrap
        $('#tabela_eventos').DataTable();

        $('#tabela_estudantes').DataTable({
            processing:true,
            serverSide:true,
            "ajax":{
                'url':"/restrito/estudantesAjax",
            },
            //pageLength:25,
            columns: [
                {data:'id'},
                {data: 'nome'},
                {data: 'email'},
                {data: 'data_nascimento'},
                {data: 'formacao'},
                {data:'created_at'}
            ]

        });
    }); // fim document ready
}


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


});