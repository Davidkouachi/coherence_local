@extends('app')

@section('titre', 'Nouveau Risque')

@section('option_btn')
    <li class="dropdown chats-dropdown">
        <a href="{{ route('index_accueil') }}" class="dropdown-toggle nk-quick-nav-icon">
            <div class="icon-status icon-status-na">
                <em class="icon ni ni-home"></em>
            </div>
        </a>
    </li>
    @if( $color_para->nbre_color > $color_interval_nbre)
    @else
    <li class="dropdown user-dropdown">
        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#">
            <div class="user-toggle">
                <div class="user-avatar">
                    <em class="icon ni ni-plus"></em>
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
            <div class="dropdown-inner">
                <ul class="link-list">
                    <li class="mt-2" >
                        <a id="ajouterGroupe" class="btn btn-md btn-primary text-white" >
                            <em class="icon ni ni-plus"></em>
                            <span>
                                Cause
                            </span>
                        </a>
                    </li>
                    <li class="mt-2" >
                        <a id="ajouterActionpr" class="btn btn-md btn-primary text-white">
                            <em class="icon ni ni-plus"></em>
                            <span>
                                Action Préventive
                            </span>
                        </a>
                    </li>
                    <li class="mt-2" >
                        <a id="ajouterActionco" class="btn btn-md btn-primary text-white">
                            <em class="icon ni ni-plus"></em>
                            <span>
                                Action corrective
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
    @endif

@endsection

@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content" style="margin:0px auto;">
                            <h3 class="text-center">
                                <span>Nouveau risque</span>
                                <em class="icon ni ni-property "></em>
                            </h3>
                        </div>
                    </div>
                </div>

                    @if( intval($color_para->nbre_color) > intval($color_interval_nbre) )
                        <div class="nk-block">
                            <div class="row g-gs">
                                <div class="col-lg-12 col-xxl-12 bg-white">
                                    <div class="modal-content">
                                        <div class="modal-body modal-body-lg text-center">
                                            <div class="nk-modal">
                                                <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-alert bg-warning"></em>
                                                <h4 class="nk-modal-title">
                                                    Paraméttrage des couleurs non complet
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $isOutOfRange = false;
                            $maxValue = ($color_para->operation === 'addition') ? (intval($color_para->nbre2) + intval($color_para->nbre2)) : (intval($color_para->nbre2) * intval($color_para->nbre2));
                        @endphp

                        @for ($i = 1; $i <= $maxValue; $i++)
                            @php
                                $isInInterval = false;
                            @endphp

                            @foreach($color_intervals as $color_interval)
                                @if ($i >= $color_interval->nbre1 && $i <= $color_interval->nbre2)
                                    @php
                                        $isInInterval = true;
                                        break; // Sortir de la boucle dès qu'un intervalle correspond
                                    @endphp
                                @endif
                            @endforeach

                            @unless($isInInterval)
                                @if($i)
                                    @php
                                        $isOutOfRange = true;
                                    @endphp
                                @endif
                            @endunless
                        @endfor

                        @if($isOutOfRange)
                            <div class="nk-block">
                                <div class="row g-gs">
                                    <div class="col-lg-12 col-xxl-12 bg-white">
                                        <div class="modal-content">
                                            <div class="modal-body modal-body-lg text-center">
                                                <div class="nk-modal">
                                                    <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-alert bg-warning"></em>
                                                    <h4 class="nk-modal-title">
                                                        Paraméttrage des couleurs non complet
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <form class="nk-block" id="form" method="post" action="{{ route('add_risque') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-gs">
                                    <div class="col-md-4 col-xxl-4 row g-2" style="margin-left:1px;">
                                        <div class="form-group col-md-12">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <span id="fileSize"> </span>
                                                    <div class="card " id="pdfPreview" style="height: 500px; " data-simplebar>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12" style="margin-top: -10px">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <div class="form-group">
                                                        <label class="form-label" for="cf-full-name">
                                                            Fichier ( .pdf )
                                                        </label>
                                                        <input autocomplete="off" id="fileInput" name="pdfFile" accept=".pdf" type="file" class="form-control" id="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-xxl-8 row g-2" style="margin-left:5px;">
                                        <div class="col-md-12 ">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <div>
                                                        <div class="row g-gs">
                                                            <div class="form-group col-md-12">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="cf-full-name">Processus</label>
                                                                    <select required name="processus_id" class="form-select" id="selectProcessus">
                                                                        <option value="">
                                                                            Choisir un processus
                                                                        </option>
                                                                        @foreach ($processuses as $processuse)
                                                                        <option value="{{ $processuse->id }}">
                                                                            {{ $processuse->nom }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-12" style="margin-top: -10px">
                                                                <label class="form-label" for="cf-full-name">Objectifs</label>
                                                                <div class="card ">
                                                                    <div class="card-inner" style="height: 100px;" data-simplebar>
                                                                        <ul id="listeObjectifs">
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <div>
                                                        <div class="row g-gs">
                                                            <div class=" form-group col-md-12">
                                                                <label class="form-label" for="cf-full-name">Risque</label>
                                                                <input placeholder="Saisir le risque" autocomplete="off" required name="nom_risque" type="text" class="form-control" id="cf-full-name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <input name="operation" type="text" value="{{ $color_para->operation }}" style="display: none;">

                                        <div class="col-md-12 ">
                                            <div class="card card-bordered h-100" id="divToChange">
                                                <div class="card-inner">
                                                    <div class="row g-gs">
                                                        <div class="col-lg-12">
                                                            <div class="card-head">
                                                                <h5 class="card-title">Evaluation risque sans dispositif de contrôle interne ou dispositif antérieur</h5>
                                                            </div>
                                                            <form action="#">
                                                                <div class="row g-4">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label">
                                                                                Vraisemblance
                                                                            </label>
                                                                            <select required name="vrai" class="form-select " id="select1">
                                                                                <option value="">
                                                                                    Choisir
                                                                                </option>
                                                                                @for ($i = 1; $i <= intval($color_para->nbre2); $i++)
                                                                                    <option value="{{ $i }}" >
                                                                                        {{ $i }}
                                                                                    </option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Gravité</label>
                                                                            <select required name="gravite" class="form-select" id="select2">
                                                                                <option value="">
                                                                                    Choisir
                                                                                </option>
                                                                                @for ($i = 1; $i <= intval($color_para->nbre2); $i++)
                                                                                    <option value="{{ $i }}" >
                                                                                        {{ $i }}
                                                                                    </option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label id="labelcolor" class="form-label" for="cf-email">Evaluation</label>
                                                                            <input disabled type="text" class="form-control text-center" id="result">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label id="labelcolor" class="form-label">Coût</label>
                                                                            <input placeholder="Entrer le montant" id="cout" autocomplete="off" required name="cout" type="text" class="form-control ">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xxl-12" id="groupesContainer">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-7">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Cause">
                                                                Cause Probable
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input placeholder="Saisie Obligatoire" autocomplete="off" id="nom_cause" required name="nom_cause[]" type="text" class="form-control" id="Cause">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group">
                                                            <label class="form-label" for="controle">
                                                                Dispositif de Contrôle
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input value="neant" placeholder="Saisie Obligatoire" autocomplete="off" id="dispositif" required name="dispositif[]" type="text" class="form-control" id="controle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xxl-12">
                                        <div class="card card-bordered" id="divToChangee">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">
                                                        Evaluation risque avec dispositif de contrôle interne actuel
                                                    </h5>
                                                </div>
                                                <div class="row g-4">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Vraisemblance
                                                            </label>
                                                            <select required name="vrai_residuel" class="form-select " id="select11">
                                                                <option value="">
                                                                    Choisir
                                                                </option>
                                                                @for ($i = 1; $i <= intval($color_para->nbre2); $i++)
                                                                    <option value="{{ $i }}" >
                                                                       {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="form-label">Gravité</label>
                                                            <select required name="gravite_residuel" class="form-select" id="select22">
                                                                <option value="">
                                                                    Choisir
                                                                </option>
                                                                @for ($i = 1; $i <= intval($color_para->nbre2); $i++)
                                                                    <option value="{{ $i }}" >
                                                                        {{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label id="labelcolor" class="form-label" for="cf-email">Evaluation</label>
                                                            <input disabled type="text" class="form-control " id="resultt">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label id="labelcolor" class="form-label">Coût</label>
                                                            <input placeholder="Entrer le montant" id="cout_residuel" autocomplete="off" required name="cout_residuel" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email-address-1">
                                                                Traitement
                                                            </label>
                                                            <select required name="traitement" class="form-select ">
                                                                <option value="">
                                                                    Choisir un traitement
                                                                </option>
                                                                <option value="reduire le risque">
                                                                    Réduire le risque
                                                                </option>
                                                                <option value="accepter le risque">
                                                                    Accepter le risque
                                                                </option>
                                                                <option value="partager le risque">
                                                                    Partager le risque
                                                                </option>
                                                                <option value="eliminer le risque">
                                                                    Éliminer le risque
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xxl-12" id="groupesActionpr">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-7">
                                                        <div class="form-group">
                                                            <label class="form-label" for="preventif">
                                                                Action préventive
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input id="actionp" autocomplete="off" placeholder="Néant" name="actionp[]" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <div class="form-group">
                                                            <label class="form-label" for="email-address-1">
                                                                Délai
                                                            </label>
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input id="delai" name="delai[]" type="date" class="form-control" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Responsabilité">
                                                                Responsabilité
                                                            </label>
                                                            <select id="responsable_idp" name="poste_idp[]" class="form-select">
                                                                <option value="">
                                                                    Choisir un responsable
                                                                </option>
                                                                @foreach ($postes as $poste)
                                                                <option value="{{ $poste->id }}">
                                                                    {{ $poste->nom }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xxl-12" id="groupesActionco">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-9">
                                                        <div class="form-group">
                                                            <label class="form-label" for="corectif">
                                                                Action corrective
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input autocomplete="off" required placeholder="Néant" id="actionc" name="actionc[]" type="text" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Responsabilité">
                                                                Responsabilité
                                                            </label>
                                                            <select id="responsable_idc" required name="poste_idc[]" class="form-select">
                                                                <option selected value="">
                                                                    Choisir un responsable
                                                                </option>
                                                                @foreach ($postes as $poste)
                                                                <option value="{{ $poste->id }}">
                                                                    {{ $poste->nom }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xxl-12">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner row g-gs">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Responsabilité">
                                                            Validateur
                                                        </label>
                                                        <select required name="poste_id" class="form-select">
                                                            <option value="">
                                                                Choisir le validateur
                                                            </option>
                                                            @foreach ($postes as $poste)
                                                            <option value="{{ $poste->id }}">
                                                                {{ $poste->nom }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xxl-12">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="card-head">
                                                    <h5 class="card-title">
                                                        Notification
                                                    </h5>
                                                </div>
                                                <div class="row g-gs">
                                                    <div class="col-lg-4 text-left">
                                                        <div class="custom-control custom-checkbox">
                                                            <input name="choix_alert_alert" value="alert" required type="checkbox" checked class="custom-control-input" id="customCheck1">
                                                            <label class="custom-control-label" for="customCheck1">Alert à l'écran</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 text-left">
                                                        <div class="custom-control custom-checkbox">
                                                            <input name="choix_alert_email" value="email" type="checkbox" class="custom-control-input" id="customCheck2">
                                                            <label class="custom-control-label" for="customCheck2">Par Email</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 text-left">
                                                        <div class="custom-control custom-checkbox">
                                                            <input name="choix_alert_sms" value="sms" disabled type="checkbox" class="custom-control-input" id="customCheck3">
                                                            <label class="custom-control-label" for="customCheck3">Par Sms</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xxl-12">
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner row g-gs">
                                                <div class="col-12">
                                                    <div class="form-group text-center">
                                                        <button type="submit" class="btn btn-lg btn-success btn-dim ">
                                                            <em class="ni ni-check me-2"></em>
                                                            <em>Soumettre</em>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoom" tabindex="-1" id="modalDetail">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="pdfPreviewmodal" data-simplebar>
            <p class="text-center mt-2">Aucun fichier sélectionner </p>
        </div>
    </div>
</div>


<script>
    const color_intervals = @json($color_intervals);

    const select1 = document.getElementById("select1");
    const select2 = document.getElementById("select2");
    const resultInput = document.getElementById("result");
    const divToChange = document.getElementById("divToChange");

    // Ajoutez des écouteurs d'événements aux sélecteurs
    select1.addEventListener("change", sum);
    select2.addEventListener("change", sum);

    // Fonction pour vérifier les valeurs et effectuer le calcul en fonction de l'opération
    function sum() {
        const num1 = parseInt(select1.value);
        const num2 = parseInt(select2.value);

        if (num1 > 0 && num2 > 0) {
            let multiplicationResult;

            if ( @json($color_para->operation) === 'addition') {
                multiplicationResult = num1 + num2;
            } else if ( @json($color_para->operation) === 'multiplication') {
                multiplicationResult = num1 * num2;
            }

            resultInput.value = multiplicationResult;

            // Itérer à travers les intervalles pour déterminer la couleur
            color_intervals.forEach(color_interval => {
                if (multiplicationResult >= color_interval.nbre1 && multiplicationResult <= color_interval.nbre2) {
                    divToChange.style.backgroundColor = color_interval.code_color ;
                    return;
                }
            });

        } else {
            resultInput.value = "";
            divToChange.style.backgroundColor = "";
        }
    }
</script>

<script>
    const color_intervalss = @json($color_intervals);
    // Sélectionnez les éléments
    const select11 = document.getElementById("select11");
    const select22 = document.getElementById("select22");
    const resultInputt = document.getElementById("resultt");
    const divToChangee = document.getElementById("divToChangee");

    // Ajoutez des écouteurs d'événements aux sélecteurs
    select11.addEventListener("change", sum);
    select22.addEventListener("change", sum);

    // Fonction pour vérifier les valeurs et effectuer la multiplication
    function sum() {
        const num11 = parseInt(select11.value);
        const num22 = parseInt(select22.value);

        if (num11 > 0 && num22 > 0) {
            let multiplicationResultt;

            if ( @json($color_para->operation) === 'addition') {
                multiplicationResultt = num11 + num22;
            } else if ( @json($color_para->operation) === 'multiplication') {
                multiplicationResultt = num11 * num22;
            }

            resultInputt.value = multiplicationResultt;

            // Itérer à travers les intervalles pour déterminer la couleur
            color_intervalss.forEach(color_interval => {
                if (multiplicationResultt >= color_interval.nbre1 && multiplicationResultt <= color_interval.nbre2) {
                    divToChangee.style.backgroundColor = color_interval.code_color ;
                    return;
                }
            });

        } else {
            resultInputt.value = "";
            divToChangee.style.backgroundColor = "";
        }
    }
</script>

<script>
    const selectProcessus = document.getElementById("selectProcessus");
    const listeObjectifs = document.getElementById("listeObjectifs");

    selectProcessus.addEventListener("change", function(event) {
        event.preventDefault();
        const processusId = selectProcessus.value;
        // Faites une requête Ajax vers le serveur Laravel pour récupérer les objectifs
        fetch(`/recherche/${processusId}`)
            .then(response => response.json())
            .then(data => {
                const objectifs = data.objectifs;
                const nbre = data.nbre;

                NioApp.Toast("<h5>Information</h5><p>" + nbre + " Objectif(s) trouvé(s).</p>", "info", {position: "top-right"});

                listeObjectifs.innerHTML = "";
                objectifs.forEach(objectif => {
                    const li = document.createElement("li");
                    li.textContent = "- " + objectif.nom;
                    listeObjectifs.appendChild(li);
                });
            })
            .catch(error => console.error("Erreur :", error));
    });
</script>

<script>
    document.getElementById("ajouterGroupe").addEventListener("click", function(event) {
        event.preventDefault();

        const nom_cause = document.getElementById("nom_cause");
        const dispositif = document.getElementById("dispositif");

        if (nom_cause.value === '' || dispositif.value === '') {

            NioApp.Toast("<h5>Information</h5><p>Veuillez saisir une cause.</p>", "info", {position: "top-right"});

        } else {

            const groupe = document.createElement("div");
            groupe.className = "card card-bordered";
            groupe.innerHTML = `
                                            <div class="card-inner">
                                                    <div class="row g-4">
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Cause">
                                                                    Cause Probable
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input id="nom_cause" placeholder="Saisie obligatoire" autocomplete="off" required name="nom_cause[]" type="text" class="form-control" id="Cause">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <div class="form-group">
                                                                <label class="form-label" for="controle">
                                                                    Dispositif de Contrôle
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input id="dispositif" value="neant" placeholder="Saisie obligatoire" autocomplete="off" required name="dispositif[]" type="text" class="form-control" id="controle">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group text-center">
                                                                <a class="btn btn-lg btn-danger btn-dim supprimerGroupe">
                                                                    <em class="ni ni-trash me-2"></em>
                                                                    <em>Supprimer</em>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                    `;

            groupe.querySelector(".supprimerGroupe").addEventListener("click", function(event) {
                event.preventDefault();
                groupe.remove();
            });

            document.getElementById("groupesContainer").appendChild(groupe);
        }
    });
</script>

<script>
    document.getElementById("ajouterActionpr").addEventListener("click", function(event) {
        event.preventDefault();

        const actionp = document.getElementById("actionp");
        const delai = document.getElementById("delai");
        const responsable_idp = document.getElementById("responsable_idp");

        if (actionp.value === '' || delai.value === '' || responsable_idp.value === '') {

            NioApp.Toast("<h5>Information</h5><p>Veuillez saisir une action preventive.</p>", "info", {position: "top-right"});

        } else {

            const groupe = document.createElement("div");
            groupe.className = "card card-bordered";
            groupe.innerHTML = `
                                            <div class="card-inner">
                                                    <div class="row g-4">
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <label class="form-label" for="preventif">
                                                                    Action préventive
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="actionp[]" type="text" class="form-control" id="preventif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="email-address-1">
                                                                    Délai
                                                                </label>
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input autocomplete="off" required name="delai[]" type="date" class="form-control" min="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Responsabilité">
                                                                    Responsabilité
                                                                </label>
                                                                <select required name="poste_idp[]" class="form-select">
                                                                    <option value="">
                                                                        Choisir un responsable
                                                                    </option>
                                                                    @foreach ($postes as $poste)
                                                                    <option value="{{ $poste->id }}">
                                                                        {{ $poste->nom }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group text-center">
                                                                <a class="btn btn-lg btn-danger btn-dim supprimerActionpr">
                                                                    <em class="ni ni-trash me-2"></em>
                                                                    <em>Supprimer</em>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                    `;

            groupe.querySelector(".supprimerActionpr").addEventListener("click", function(event) {
                event.preventDefault();
                groupe.remove();
            });

            document.getElementById("groupesActionpr").appendChild(groupe);

        }

    });
</script>

<script>
    document.getElementById("ajouterActionco").addEventListener("click", function(event) {
        event.preventDefault();

        const actionc = document.getElementById("actionc");
        const responsable_idc = document.getElementById("responsable_idc");

        if (actionc.value === '' || responsable_idc.value === '') {

            NioApp.Toast("<h5>Information</h5><p>Veuillez saisir une action corrective.</p>", "info", {position: "top-right"});

        } else {

            const groupe = document.createElement("div");
            groupe.className = "card card-bordered";
            groupe.innerHTML = `
                                            <div class="card-inner">
                                                    <div class="row g-4">
                                                        <div class="col-lg-9">
                                                            <div class="form-group">
                                                                <label class="form-label" for="corectif">
                                                                    Action corrective
                                                                </label>
                                                                <div class="form-control-wrap">
                                                                    <input placeholder="Saisie obligatoire" autocomplete="off" required name="actionc[]" type="text" class="form-control" id="corectif">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <label class="form-label" for="Responsabilité">
                                                                    Responsabilité
                                                                </label>
                                                                <select required name="poste_idc[]" class="form-select">
                                                                    <option value="">
                                                                        Choisir un responsable
                                                                    </option>
                                                                    @foreach ($postes as $poste)
                                                                    <option value="{{ $poste->id }}">
                                                                        {{ $poste->nom }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group text-center">
                                                                <a class="btn btn-lg btn-danger btn-dim supprimerActionco">
                                                                    <em class="ni ni-trash me-2"></em>
                                                                    <em>Supprimer</em>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                    `;

            groupe.querySelector(".supprimerActionco").addEventListener("click", function(event) {
                event.preventDefault();
                groupe.remove();
            });

            document.getElementById("groupesActionco").appendChild(groupe);
        }
    });
</script>

<script>
    const fileInput = document.getElementById('fileInput');
    const pdfPreview = document.getElementById('pdfPreview');
    const fileSizeElement = document.getElementById('fileSize');
    var pdfFiles = @json($pdfFiles);
    var pdfFiles2 = @json($pdfFiles2);

    fileInput.addEventListener('change', function() {
        // Initialiser la variable trouver
        let trouver = 0;

        var selectedFileName = this.value.split('\\').pop(); // Récupérer le nom du fichier sélectionné

        // Parcourir la liste des fichiers
        pdfFiles.forEach(function(pdfFile) {
            if (selectedFileName === pdfFile.pdf_nom) {

                NioApp.Toast("<h5>Erreur</h5><p>Ce fichier PDF existe déjà.</p>", "error", {position: "top-right"});

                fileInput.value = ''; // Vider l'input

                trouver = 1;
                
                pdfPreview.innerHTML = '';
                fileSizeElement.textContent = '';
            }
        });
        pdfFiles2.forEach(function(pdfFile2) {
            if (selectedFileName === pdfFile2.pdf_nom) {

                NioApp.Toast("<h5>Erreur</h5><p>Ce fichier PDF existe déjà.</p>", "error", {position: "top-right"});

                fileInput.value = ''; // Vider l'input
                trouver = 1;
                    
                pdfPreview.innerHTML = '';
                fileSizeElement.textContent = '';
            }
        });

        // Vérifier la valeur de trouver avant de procéder
        if (trouver === 0) {
            // Obtenez le fichier PDF sélectionné
            const fichier = fileInput.files[0];

            // Vérifiez si un fichier a été sélectionné
            if (fichier) {
                // Créez un élément d'incorporation pour le fichier PDF
                const embedElement = document.createElement('embed');
                embedElement.src = URL.createObjectURL(fichier);
                embedElement.type = 'application/pdf';
                embedElement.style.width = '100%';
                embedElement.style.height = '100%';
                // Affichez l'élément d'incorporation dans la div de prévisualisation
                pdfPreview.innerHTML = '';
                pdfPreview.appendChild(embedElement);
                // Affichez la taille du fichier
                const fileSize = fichier.size; // Taille du fichier en octets
                const fileSizeInKB = fileSize / 1024; // Taille du fichier en kilo-octets
                fileSizeElement.textContent = `Taille du fichier : ${fileSizeInKB.toFixed(2)} Ko`;
            } else {
                // Si aucun fichier n'est sélectionné, videz la div de prévisualisation et l'élément de la taille du fichier
                pdfPreview.innerHTML = '';
                fileSizeElement.textContent = '';
            }
        }
    });
</script>

    <script>
        function formatPrice(input) {
            input = input.replace(/\./g, '');
            
            return input.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        document.getElementById('cout').addEventListener('input', function() {
            this.value = formatPrice(this.value);
        });

        document.getElementById('cout_residuel').addEventListener('input', function() {
            this.value = formatPrice(this.value);
        });

        document.getElementById('cout').addEventListener('keypress', function(event) {
            const key = event.key;
            if (isNaN(key)) {
                event.preventDefault();
            }
        });

        document.getElementById('cout_residuel').addEventListener('keypress', function(event) {
            const key = event.key;
            if (isNaN(key)) {
                event.preventDefault();
            }
        });
    </script>

@endsection

