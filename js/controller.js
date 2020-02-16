// Controller fuer Events


function fill() {
    var div = document.createElement("div");
}

var selectGemeinde = $('#selectGemeinde');
var selectImmobilieTyp = $('#selectTyp');
var selectAnzahlZimmer = $('#selectZimmer');
var selectSliderFlaeche = $('#sliderFlaeche');
var selectSliderPreis = $('#sliderPreis');

//LocalStorage

$(function () {
    selectGemeinde.change(function () {
        localStorage.setItem('gemeinde', this.value);
    });

    if (localStorage.getItem('gemeinde')) {
        selectGemeinde.val(localStorage.getItem('gemeinde'));
    }
});

$(function () {
    selectImmobilieTyp.change(function () {
        localStorage.setItem('immobilieTyp', this.value);
    });

    if (localStorage.getItem('immobilieTyp')) {
        selectImmobilieTyp.val(localStorage.getItem('immobilieTyp'));
    }
});

$(function () {
    selectAnzahlZimmer.change(function () {
        localStorage.setItem('anzahlZimmer', this.value);
    });

    if (localStorage.getItem('anzahlZimmer')) {
        selectAnzahlZimmer.val(localStorage.getItem('anzahlZimmer'));
    }
});

function setUpEventHandlers() {
    $("#sliderFlaeche").change(function() {
        localStorage[this.id] = $(this).val();
    });
}

$(function() {
    setUpEventHandlers();
});

function setUpEventHandlersPreis() {
    $("#sliderPreis").change(function() {
        localStorage[this.id] = $(this).val();
    });
}

$(function() {
    setUpEventHandlersPreis();
});

function LookupLocalStorage() {
    for (var i = 0; i < localStorage.length; i++) {
        alert(localStorage.getItem(localStorage.key(i)));
    }
}

function loadProfil() {
    $(function () {
        selectGemeinde.change(function () {
            localStorage.setItem('gemeinde', this.value);
        });

        if (localStorage.getItem('gemeinde')) {
            selectGemeinde.val(localStorage.getItem('gemeinde')).trigger('change');
        }
    });

    $(function () {
        selectImmobilieTyp.change(function () {
            localStorage.setItem('immobilieTyp', this.value);
        });

        if (localStorage.getItem('immobilieTyp')) {
            selectImmobilieTyp.val(localStorage.getItem('immobilieTyp')).trigger('change');
        }
    });

    $(function () {
        selectAnzahlZimmer.change(function () {
            localStorage.setItem('anzahlZimmer', this.value);
        });

        if (localStorage.getItem('anzahlZimmer')) {
            selectAnzahlZimmer.val(localStorage.getItem('anzahlZimmer')).trigger('change');
        }
    });

    $(function () {
        selectSliderFlaeche.change(function () {
            localStorage.setItem('sliderFlaeche', this.value);
        });

        if (localStorage.getItem('sliderFlaeche')) {
            selectSliderFlaeche.val(localStorage.getItem('sliderFlaeche')).trigger('change');
        }
    });
    
          function LookupLocalStorage() {
        for (var i = 0; i < localStorage.length; i++) {
            alert(localStorage.getItem(localStorage.key(i)));
        }
    }

    $("#sliderFlaeche").each(function() {
        if (typeof localStorage[this.id] !== "undefined") {
            $(this).val(localStorage[this.id]);
        }
    });
    
    $('#sliderFlaeche').val(localStorage.getItem("sliderFlaeche")).trigger('change');
    
    $("#sliderPreis").each(function() {
        if (typeof localStorage[this.id] !== "undefined") {
            $(this).val(localStorage[this.id]);
        }
    });
    
    $('#sliderPreis').val(localStorage.getItem("sliderPreis")).trigger('change');
    
    window.alert("Ihr letztes Suchprofil wurde geladen!");
}
function resetProfil() {
    //reset localStorage
    localStorage.setItem('gemeinde', 'all');
    localStorage.setItem('immobilieTyp', 'all');
    localStorage.setItem('anzahlZimmer', '0');
    localStorage.setItem('sliderFlaeche', '100');
    localStorage.setItem('sliderPreis', '50');

    //reset menus
    selectGemeinde.val('all');
    selectGemeinde.selectmenu('refresh', true);
    selectImmobilieTyp.val('all');
    selectImmobilieTyp.selectmenu('refresh', true);
    selectAnzahlZimmer.val('0');
    selectAnzahlZimmer.selectmenu('refresh', true);
    
    // Slider reset
    $("#sliderFlaeche").val(100).slider("refresh");
    //Slider reset
    $("#sliderPreis").val(50).slider("refresh");
    
    window.alert("Ihr Suchprofil wurde zurückgesetzt!");
}


//Proof of concept - Immobilien filtern
/*
function toImmobilieButton() {

    //Hole localStorage
    var gemeinde = localStorage.getItem('gemeinde'); 
    var immobilieTyp = localStorage.getItem('immobilieTyp'); 
    var anzahlZimmer = localStorage.getItem('anzahlZimmer'); 
    var minWohnflaeche = localStorage.getItem('minWohnflaeche'); 
    var maxPreis = localStorage.getItem('maxPreis'); 

    //Neues Array
    //   var matchImmo = [];
    //Durchlauf des Array
    for (i = 0; i < immobilien.length; i++){
        //ALLE PARAMETER
        if (immobilien[i].anzahlZimmer >= anzahlZimmer && immobilien[i].wohnflaeche >= minWohnflaeche && immobilien[i].preis >= maxPreis)

            //Wenn dann Push ins neue Array
        { //matchImmo.push(immobilien[i])

            //TEST ALERT erstes Array //lenght das letzte hinzugefügt
            //Alle Attribute des Objekts
            //window.alert(JSON.stringify(immobilien[i]))


            var nextId = i;

            var content =  

                "<div data-role='collapsible' data-content-theme='b' id='set" +nextId +"'><h3>Immobilie" +nextId +"</h3><div data-role='collapsible-set' data-theme='c' data-content-theme='b'><h3 id='immobilieTitel" +nextId +"'>Titel</h3>  <p id='immobilieBeschreibung" +nextId +"'>Beschreibung:</p><p id='immobilieArt" +nextId +"'>Art:</p><p id='immobilieStrasse" +nextId +"'></p><p id='immobilieHausnummer" +nextId +"'></p><p id='immobilieGemeinde" +nextId +"'></p><p id='immobiliePlz" +nextId +"'></p><p id='immobiliePreis" +nextId +"'></p><p id='immobilieZimmer" +nextId +"'></p><p id='immobilieWohnfläche" +nextId +"'></p><p id='immobilieGrundstuecksflaeche" +nextId +"'></p><p id='immobilieVerfuegbarkeit" +nextId +"'></p><p id='immobilieBaujahr" +nextId +"'></p><h4>Ausstattung:</h4><p id='immobilieLift" +nextId +"'></p><p id='immobilieBalkon" +nextId +"'></p><p id='immobilieGarten" +nextId +"'></p><div id='immobilieBilder" +nextId +"' data-role='collapsible'><h3>Bildergalerie</h3><ul data-role='listview" +nextId +"' ><li><img id='Foto1" +nextId +"'></li><li><img id='Foto2" +nextId +"'></li><li><img id='Foto3" +nextId +"'></li></ul></div><div data-role='collapsible-set' data-theme='c' data-content-theme='b'><div data-role='collapsible'><h3>Karte:</h3><p id='immobilieStandort" +nextId +"'>Karte</p></div></div><div data-role='collapsible-set" +nextId +"' data-theme='c' data-content-theme='b'>  <div data-role='collapsible'><h3 id='gemeindeName" +nextId +"'>Gemeinde</h3><ul><p id='gemeindePlz" +nextId +"'></p><p id='gemeindeKanton" +nextId +"'></p><p id='gemeindeEinwohner" +nextId +"'></p><p id='ajaxcontent" +nextId +"'></p><p id='gemeindeBeschreibung" +nextId +"'></p><p id='gemeindeUrl" +nextId +"'></p><p id='gemeindeSteuerfuss" +nextId +"'></p></ul><h4>Infrastruktur:</h4><ul><p id='gemeindeEinkauf" +nextId +"'></p><p id='gemeindeSpital" +nextId +"'></p></ul><h5>Bildung:</h5><ul><p id='gemeindeKindergarten" +nextId +"'></p><p id='gemeindePrimarschule" +nextId +"'></p><p id='gemeindeSekundarschule" +nextId +"'></p><p id='gemeindeKantonsschule" +nextId +"'></p><p id='gemeindeHochschule" +nextId +"'></p><p id='gemeindeUniversitaet" +nextId +"'></p></ul><div id='gemeindeBilder' data-role='collapsible'data-mini='true'><h3>Bildergalerie</h3><ul data-role='listview" +nextId +"' ><li><img id='FotoGem1" +nextId +"'></li><li><img id='FotoGem2" +nextId +"'></li><li><img id='FotoGem3" +nextId +"'></li></ul></div></div></div></div></div>";


            $("#set").append( content )
            //Fetch DATA, hier kommt die dynamische Bindung !
            $("#immobilieBeschreibung" + nextId).text(immobilien[i].beschreibung);
            //... TODO
        }

    } 

}*/