@extends('app')

@section('titre', 'A propos')

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
                <div class="components-preview wide-lg mx-auto">
                    <div class="nk-block-head nk-block-head-lg wide-sm">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">
                                A propos
                            </h2>
                        </div>
                    </div>
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <div class="accordion accordion-s2" id="accordion-1">
                                    <div class="accordion-item">
                                        <a class="accordion-head" data-bs-target="#accordion-item-1-1" data-bs-toggle="collapse" href="#">
                                            <h6 class="title">
                                                Objectifs de l'application
                                            </h6>
                                            <span class="accordion-icon">
                                            </span>
                                        </a>
                                        <div class="accordion-body collapse show" data-bs-parent="#accordion-1" id="accordion-item-1-1">
                                            <div class="accordion-inner">
                                                <p>
                                                    L’application Coherence Risk – CRM est conçue pour répondre a plusieurs besoins essentiels liées a la gestion des risques et des incidents d’une organisation. Cette application permettra la mise en œuvre automatique du point 10.2 de la norme ISO 9001 version 2015. 
                                                </p>
                                                <p>
                                                    Coherence Risk – CRM est une application multifonction qui vous permettra de :
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <a class="accordion-head collapsed" data-bs-target="#accordion-item-1-2" data-bs-toggle="collapse" href="#">
                                            <h6 class="title">
                                                Automatiser votre gestion des risques de vos processus 
                                            </h6>
                                            <span class="accordion-icon">
                                            </span>
                                        </a>
                                        <div class="accordion-body collapse" data-bs-parent="#accordion-1" id="accordion-item-1-2">
                                            <div class="accordion-inner">
                                                <p>
                                                    Dans de nombreuses entreprises, la gestion des risques des processus est un processus
                                                    complexe et essentiel. Coherence Risk - CRM vise à automatiser cette gestion en
                                                    fournissant des outils et des fonctionnalités permettant d'identifier, d'évaluer et de
                                                    gérer les risques associés à chaque processus de l'entreprise. Cela permet d'améliorer la
                                                    visibilité sur les risques potentiels, de prendre des mesures préventives et de réduire les
                                                    impacts négatifs sur les opérations.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <a class="accordion-head collapsed" data-bs-target="#accordion-item-1-3" data-bs-toggle="collapse" href="#">
                                            <h6 class="title">
                                                Gérer vos non-conformités, réclamations et contentieux de vos incidents
                                            </h6>
                                            <span class="accordion-icon">
                                            </span>
                                        </a>
                                        <div class="accordion-body collapse" data-bs-parent="#accordion-1" id="accordion-item-1-3">
                                            <div class="accordion-inner">
                                                <p>
                                                    L'application offre également des fonctionnalités pour gérer les non-conformités, les
                                                    réclamations et les contentieux des incidents. Ces aspects sont cruciaux pour assurer la
                                                    conformité aux normes et réglementations, ainsi que pour garantir la satisfaction des
                                                    clients et des parties prenantes. Coherence Risk - CRM permet de documenter, suivre et
                                                    résoudre efficacement les non-conformités et les réclamations, tout en gérant les litiges
                                                    éventuels résultant d'incidents.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <a class="accordion-head collapsed" data-bs-target="#accordion-item-1-4" data-bs-toggle="collapse" href="#">
                                            <h6 class="title">
                                                Evaluer l’efficacité des actions mises en place face aux risques
                                            </h6>
                                            <span class="accordion-icon">
                                            </span>
                                        </a>
                                        <div class="accordion-body collapse" data-bs-parent="#accordion-1" id="accordion-item-1-4">
                                            <div class="accordion-inner">
                                                <p>
                                                    Une composante clé de la gestion des risques est l'évaluation de l'efficacité des actions
                                                    prises pour atténuer ou contrôler ces risques. Coherence Risk - CRM fournit des
                                                    mécanismes pour évaluer et suivre l'impact des actions correctives et préventives mises
                                                    en place pour faire face aux risques identifiés. Cela permet à l'organisation d'ajuster ses
                                                    stratégies et ses plans d'action en fonction des résultats obtenus, afin d'améliorer
                                                    continuellement sa capacité à gérer les risques.
                                                </p>
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
    </div>
</div>

@endsection
