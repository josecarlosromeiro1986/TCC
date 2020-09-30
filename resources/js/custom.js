$(document).ready(function () {
    $('.rg').mask('0000000-0');
    $('.cep').mask('00000-000');
    $('.cpf').mask('000.000.000-00');
    $('.cnpj').mask('00.000.000/0000-00');
    $('.phone').mask(SPMaskBehavior, spOptions);
});

var hidden = 0;

$(function () {
    let isMobile = window.matchMedia("only screen and (max-width: 760px)").matches;

    if (isMobile) {
        this.hidden = 1;
        sideBar();
    }
});

(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},

    spOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };

function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('address').value = ("");
    document.getElementById('neighborhood').value = ("");
    document.getElementById('complement').value = ("");
    document.getElementById('city').value = ("");
    document.getElementById('state').value = ("");
    document.getElementById('state').value = ("");
    //document.getElementById('ibge').value=("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('address').value = (conteudo.logradouro);
        document.getElementById('neighborhood').value = (conteudo.bairro);
        document.getElementById('complement').value = (conteudo.complemento);
        document.getElementById('city').value = (conteudo.localidade);
        document.getElementById('state').value = (conteudo.uf);
        //document.getElementById('ibge').value=(conteudo.ibge);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {
    addLoading();
    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('address').value = "...";
            document.getElementById('neighborhood').value = "...";
            document.getElementById('complement').value = ("...");
            document.getElementById('city').value = "...";
            document.getElementById('state').value = "...";
            //document.getElementById('ibge').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
    removeLoading();
};

function addLoading() {
    document.getElementById('loading').classList.add("spinner-border");
    document.getElementById('loading').classList.add("spinner-border-sm");
    document.getElementById('loading').classList.add("text-info");
}

function removeLoading() {
    document.getElementById('loading').classList.remove("spinner-border");
    document.getElementById('loading').classList.remove("spinner-border-sm");
    document.getElementById('loading').classList.remove("text-info");
}

var previous = 0;

function activateItem(id) {
    if (this.previous > 0) {
        document.getElementById(this.previous).classList.remove("activeElement");
    }
    document.getElementById(id).classList.add("activeElement");
    this.previous = id;
}

function sideBar() {

    if (this.hidden === 0) {
        document.getElementById('menu').classList.add("toHide");
        document.getElementById('site-content').classList.add("expand");
        document.getElementById('btn-sideBar').classList.add("fa-angle-double-right");
        this.hidden = 1;
    }
    else {
        document.getElementById('menu').classList.remove("toHide");
        document.getElementById('site-content').classList.remove("expand");
        document.getElementById('btn-sideBar').classList.remove("fa-angle-double-right");
        this.hidden = 0;
    }
}
