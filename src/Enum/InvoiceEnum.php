<?php

namespace App\Enum;


enum InvoiceEnum: string
{

    case BROUILLON = "brouillon";

    case ATTENTE = "en attente de paiement";
    case PAYÉ = "payée";

}