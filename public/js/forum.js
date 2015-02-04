var Forum = {};
Forum.ID_FORUM_ID = "forumId";
Forum.ID_USUARIO = "usuario";
Forum.ID_TITULO = "titulo";
Forum.ID_TEXTO = "texto";
Forum.__inserirTopicoNaPagina = function (resposta) {
    console.log(resposta);
    if (resposta.inserido === 'OK') {
        jQuery('#topicos>ul').append('<li class="topico">' + $('#' + Forum.ID_TITULO).val() + '</li>')
    } 
};
Forum.getDadosNovoTopico = function () {
    var forumId,
            usuario,
            titulo,
            texto;
    forumId = parseInt($('#' + Forum.ID_FORUM_ID).val());
    usuario = $('#' + Forum.ID_USUARIO).val();
    titulo = $('#' + Forum.ID_TITULO).val();
    texto = $('#' + Forum.ID_TEXTO).val();
    return {forumId: forumId, usuario: usuario, titulo: titulo, texto: texto};
};
Forum.criarRequisicaoAjax = function () {
    var dados = Forum.getDadosNovoTopico();
    return jQuery.ajax({"type": 'POST',
        "dataType": 'json',
        "url": '/tu/forum/' + dados.forumId + '/novo-topico',
        "data": {usuario: dados.usuario,
            titulo: dados.titulo,
            texto: dados.texto
        }
    });
};
Forum.criarNovoTopico = function () {
    var xhr = Forum.criarRequisicaoAjax();
    return Promise.resolve(xhr).then(Forum.__inserirTopicoNaPagina);
};


               