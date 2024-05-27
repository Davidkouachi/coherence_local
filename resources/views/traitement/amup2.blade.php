@extends('app')

@section('titre', 'Fiche Amélioration')

@section('option_btn')

<li class="dropdown chats-dropdown">
    <a href="{{ route('index_accueil') }}" class="dropdown-toggle nk-quick-nav-icon">
        <div class="icon-status icon-status-na">
            <em class="icon ni ni-home"></em>
        </div>
    </a>
</li>
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
                                <span>Mise à jour de la Fiche d'incident</span>
                                <em class="icon ni ni-reports"></em>
                            </h3>
                        </div>
                        <div class="nk-block-head-content">
                                        <a href="{{ route('index_amup') }}" class="btn btn-danger btn-outline-white d-none d-sm-inline-flex">
                                            <em class="icon ni ni-arrow-left"></em>
                                            <span>Retour</span>
                                        </a>
                                        <a href="{{ route('index_amup') }}" class="btn btn-danger btn-outline-white d-inline-flex d-sm-none">
                                            <em class="icon ni ni-arrow-left"></em>
                                        </a>
                                    </div>
                    </div>
                </div>
                <form id="form" class="nk-block" method="post" action="{{ route('amup2_traitement') }}">
                    @csrf
                    <input type="text" value="{{ $am->id }}" name="amelioration_id" style="display: none;" >
                    <div class="row g-gs">
                        <div class="col-md-12 col-xxl-12" id="groupesContainer">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Cause">
                                                    Motif(s)
                                                </label>
                                                <div class="form-control-wrap">
                                                    <textarea disabled  class="form-control no-resize" id="default-textarea">{{ $am->motif }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xxl-6">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">
                                            Type 
                                            <em class="ni ni-block-over" ></em>
                                        </h5>
                                    </div>
                                    <div class="row g-4 ">
                                        <div class="col-lg-4">
                                            <div class="form-group text-center">
                                                <div class="custom-control custom-radio">
                                                    <input @php if ($am->type === 'non_conformite_interne') { echo "checked"; } @endphp required type="radio" class="custom-control-input" name="type" id="customRadio7" value="non_conformite_interne">
                                                    <label class="custom-control-label" for="customRadio7">
                                                        Non conformité interne
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group text-center">
                                                <div class="custom-control custom-radio">
                                                    <input @php if ($am->type === 'reclamation') { echo "checked"; } @endphp required type="radio" class="custom-control-input" name="type" id="customRadio6" value="reclamation">
                                                    <label class="custom-control-label" for="customRadio6">
                                                        Reclamation
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group text-center">
                                                <div class="custom-control custom-radio">
                                                    <input @php if ($am->type === 'contentieux') { echo "checked"; } @endphp required type="radio" class="custom-control-input" name="type" id="customRadio5" value="contentieux">
                                                    <label class="custom-control-label" for="customRadio5">
                                                        Contentieux
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                    <div class="col-lg-6 col-xxl-6">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="row g-4">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Date de reception
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input id="date" name="date_fiche" type="date" class="form-control" value="{{ $am->date_fiche }}" onchange="checkDate()" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Nombre de jours
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <select id="nbre_jour" required name="nbre_jour" class="form-select " >
                                                                    <?php $nbre = intval($am->nbre_jour); ?>
                                                                    @for ($i = 1; $i <= 31; $i++)
                                                                        <option {{ $i === $nbre ? 'selected' : '' }} value="{{ $i }}" >
                                                                            {{ $i }}
                                                                        </option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">
                                                                Date limite de traitement
                                                            </label>
                                                            <div class="form-control-wrap">
                                                                <input readonly id="date_limite" name="date_limite" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        <div class="col-lg-12 col-xxl-12" id="groupesContainer">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="controle">
                                                    Lieu
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input required placeholder="Saisie obligatoire" name="lieu" type="text" class="form-control" value="{{ $am->lieu }}" id="controle">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="controle">
                                                    Détecteur (Agent / Client)
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input required placeholder="Saisie obligatoire" name="detecteur" type="text" class="form-control" value="{{ $am->detecteur }}" id="controle">
                                                </div>
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
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Cause">
                                                    Non conformité
                                                </label>
                                                <div class="form-control-wrap">
                                                    <input required placeholder="Saisie obligatoire" name="non_conformite" id="inputMots" type="text" class="form-control" value="{{ $am->non_conformite }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="Cause">
                                                    Conséquence(s)
                                                </label>
                                                <div class="form-control-wrap" id="resultat">
                                                    <textarea required name="consequence" class="form-control no-resize" id="default-textarea">{{ $am->consequence }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="Cause">
                                                    Cause(s)
                                                </label>
                                                <div class="form-control-wrap">
                                                    <textarea required name="cause" class="form-control no-resize" id="default-textarea">{{ $am->cause }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xxl-12" id="groupesContainer">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="card-head">
                                        <h5 class="card-title">
                                            Resultat de la recherche :
                                            @if($am->choix_select === 'cause_risque_nt')
                                                Aucun risque ou cause trouvé
                                            @endif
                                            @if($am->choix_select === 'risque')
                                                Risque trouvé
                                            @endif
                                            @if($am->choix_select === 'cause')
                                                Cause trouvée
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="card-head">
                                        <h5 class="card-title">
                                            @if($am->choix_select === 'risque')
                                                Risque : {{$am->nom_risque}}
                                            @elseif($am->choix_select === 'cause')
                                                Cause : {{$am->nom_cause}}
                                            @elseif($am->choix_select === 'cause_risque_nt')
                                                Nouveau Risque : {{$am->nom_new_risque}}
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xxl-12 ">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="row g-4">
                                        @foreach($actionsDatam[$am->id] as $key => $actions)
                                        <div class="col-md-12 col-xxl-12">
                                            <div class="card ">
                                                <div class="card-inner">
                                                    <div class="row g-4">
                                                        <div class="col-lg-12 col-xxl-12">
                                                            <div class="card">
                                                                <div class="card-inner">
                                                                    <div class="card-head">
                                                                        {{ $key+1 }}
                                                                    </div>
                                                                    <input type="text" value="{{ $actions['suivi_id'] }}" name="suivi_id[]" style="display: none;">
                                                                    <div class="row g-4">
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Cause">
                                                                                    Processus
                                                                                </label>
                                                                                <select disabled class="form-select js-select2">
                                                                                    @foreach($processuss as $processus)
                                                                                    <option {{ $actions['processus_id'] === $processus->id ? 'selected' : '' }}  value="{{$processus->id}}">
                                                                                        {{$processus->nom}}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="controle">
                                                                                    Risque
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input disabled value="{{ $actions['risque'] }}" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @if($actions['trouve'] === 'cause')
                                                                        <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="controle">
                                                                                    Causes
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input value="{{ $actions['cause'] }}" disabled type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        <div class="col-lg-7">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="controle">
                                                                                    Action Corrective
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <input disabled value="{{ $actions['action'] }}" type="text" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="Coût">
                                                                                    Responsable
                                                                                </label>
                                                                                <select disabled name="poste_id[]" class="form-select js-select2">
                                                                                    @foreach($postes as $poste)
                                                                                    <option {{ $actions['poste_id'] === $poste->id ? 'selected' : '' }}  value="{{$poste->id}}">
                                                                                        {{$poste->nom}}
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <div class="form-group text-center">
                                                                                <label class="form-label" for="description">
                                                                                    Commentaire
                                                                                </label>
                                                                                <div class="form-control-wrap">
                                                                                    <textarea required name="commentaire_am[]" class="form-control no-resize" id="default-textarea">{{ $actions['commentaire_am'] }}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 text-left">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input value="{{ $actions['suivi_id'] }}" name="id_suppr[{{$key+1}}]" type="text" style="display: none;">
                                                                                <input name="suppr[{{$key+1}}]" value="oui" type="checkbox" class="custom-control-input" id="customCheck1_{{$key+1}}">
                                                                                <label class="custom-control-label" for="customCheck1_{{$key+1}}">
                                                                                    Supprimé
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="dynamic-fields">

                        </div>

                        <div class="col-md-12 col-xxl-12">
                            <div class="card card-bordered card-preview">
                                <div class="card-inner row g-gs">
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-lg btn-success btn-dim ">
                                                <em class="ni ni-check me-2"></em>
                                                <em>Terminé</em>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<ul class="nk-sticky-toolbar" >
    <li class="demo-settings" id="btn-new-action"> 
        <a class="toggle tipinfo action_new" aria-label="Nouvelle Action" data-bs-original-title="Nouvelle Action" data-type="new">
            <em class="icon ni ni-plus">
            </em>
        </a>
    </li>
</ul>

<script>
    var postes = @json($postes);
    var processuss = @json($processuss);
</script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxesCause = document.querySelectorAll('input[name^="suppr["]');

            checkboxesCause.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedCount = document.querySelectorAll('input[name^="suppr["]:checked').length;

                    if (checkedCount === checkboxesCause.length) {
                        // Si toutes les cases sont cochées, décocher la dernière case cochée
                        checkbox.checked = false;

                        NioApp.Toast("<h5>Alert</h5><p>Impossible de supprimé cette action.</p>", "warning", {position: "top-right"});
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Écoute des changements sur le champ de date et le champ du nombre de jours
            document.getElementById('date').addEventListener('change', updateDateLimite);
            document.getElementById('nbre_jour').addEventListener('change', updateDateLimite);

            function updateDateLimite() {
                var dateDebut = document.getElementById('date').value;
                var nbreJours = parseInt(document.getElementById('nbre_jour').value);

                // Vérification si la date de début est sélectionnée et le nombre de jours est valide
                if (dateDebut && !isNaN(nbreJours)) {
                    var dateLimite = new Date(dateDebut);
                    dateLimite.setDate(dateLimite.getDate() + nbreJours);

                    // Extraction des éléments de date individuels
                    var jour = ('0' + dateLimite.getDate()).slice(-2); // Jour
                    var mois = ('0' + (dateLimite.getMonth() + 1)).slice(-2); // Mois (ajouter +1 car les mois commencent à 0)
                    var annee = dateLimite.getFullYear(); // Année

                    // Formatage de la date au format dd/mm/aaaa
                    var formattedDate = jour + '/' + mois + '/' + annee;

                    // Mettre à jour la valeur du champ "Date limite de traitement"
                    document.getElementById('date_limite').value = formattedDate;
                }
            }

            // Appel initial pour mettre à jour la date limite lors du chargement de la page
            updateDateLimite();
        });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".action_new").forEach(function(button) {
            button.addEventListener("click", function() {
                var type = this.getAttribute("data-type");
                addGroup(type);
            });
        });
    });

    function addGroup(type_new) {

        var groupe = document.createElement("div");
        groupe.className = "card card-bordered";
        groupe.innerHTML = `
                                        <div class="card-inner">
                                            <div class="row g-4">
                                                <div class="col-lg-12 col-xxl-12" >
                                                    <div class="card">
                                                        <div class="card-inner">
                                                            <div class="card-head">
                                                                <span class="badge badge-dot bg-primary">
                                                                    Nouveau
                                                                </span>
                                                            </div>
                                                                <div class="row g-4">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Cause">
                                                                                Processus
                                                                            </label>
                                                                            <input required style="display:none;" name="nature1[]" value="new" type="text" >
                                                                            <select required id="responsable_idc" required name="processus_id1[]" class="form-select">
                                                                                <option selected value="">
                                                                                    Choisir un responsable
                                                                                </option>
                                                                                ${processuss.map(processus => `<option value="${processus.id}">${processus.nom}</option>`).join('')}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Risque
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input required placeholder="Saisie obligatoire" name="risque1[]" type="text" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Résumé des causes
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input required placeholder="Saisie obligatoire" name="resume1[]" type="text" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                            <div class="form-group">
                                                                            <label class="form-label" for="controle">
                                                                                Action Corrective
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <input required placeholder="Saisie obligatoire" name="action1[]" type="text" class="form-control" >
                                                                            </div>
                                                                        </div>
                                                                                <div class="form-group">
                                                                                    <label class="form-label" for="Coût">
                                                                                        Responsable
                                                                                    </label>
                                                                                    <select required id="responsable_idc" required name="poste_id1[]" class="form-select">
                                                                                        <option selected value="">
                                                                                            Choisir un responsable
                                                                                        </option>
                                                                                        ${postes.map(poste => `<option value="${poste.id}">${poste.nom}</option>`).join('')}
                                                                                    </select>
                                                                                </div>
                                                                    </div>
                                                                    <div class="col-lg-5">
                                                                        <div class="form-group text-center">
                                                                            <label class="form-label" for="description">
                                                                                Commentaire
                                                                            </label>
                                                                            <div class="form-control-wrap">
                                                                                <textarea required name="commentaire1[]" class="form-control no-resize" id="default-textarea"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group text-center">
                                                                            <a class="btn btn-outline-danger btn-dim " id="suppr_nouvelle_action" >
                                                                                Supprimer
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                `;

        groupe.querySelector("#suppr_nouvelle_action").addEventListener("click", function(event) {
            event.preventDefault();

            groupe.remove();
        });

        document.getElementById("dynamic-fields").appendChild(groupe);
    }
</script>

@endsection
