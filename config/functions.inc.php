<?php

function afficherNoteVendeur($note, $nbr_avis, $id_vendeur = null, $has_link = false)
{
    $txt = ' note';
    if ($nbr_avis > 1)
        $txt .= 's';
    if (!is_numeric($nbr_avis))
        $txt = null;

    $result = '';
    $result .= '<div class="ratings">';

    $k = 1;
    for ($j = 0; $j < 5; $j++) :
        $class = '';
        $icon = 'star_border';
        if ($k <= $note) :
            $class = ' full';
            $icon = 'star';
        endif;

        $result .= '<span class="material-icons-outlined'.$class.'">'.$icon.'</span>';
        
        $k++;
    endfor;
    $result .= '<div class="number-ratings">(';
    if ($has_link && is_numeric($nbr_avis))
        $result .= '<a href="#" class="show-user-reviews" data-bs-toggle="modal" data-bs-target="#ratingslist" data-user="'.$id_vendeur.'">';
        
    $result .= $nbr_avis.$txt;
    
    if ($has_link && is_numeric($nbr_avis))
        $result .= '</a>';
    
    $result .= ')</div>';
    $result .= '</div>';

    return $result;
}

function afficherNoteDonnee($note)
{
    $result = '';
    $result .= '<div class="rate-top-right">';

    $k = 1;
    for ($j = 0; $j < 5; $j++) :
        $class = '';
        $icon = 'star_border';
        if ($k <= $note) :
            $class = ' full';
            $icon = 'star';
        endif;

        $result .= '<span class="material-icons-outlined'.$class.'">'.$icon.'</span>';
        $k++;
    endfor;
    $result .= '</div>';

    return $result;
}

function genererNumeroCommande()
{
    $lettres = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    $numero_commande = '';
    $place_lettre = rand(0, 4);

    for ($i = 0; $i < 5; $i++)
    {
        if ($i == $place_lettre)
            $numero_commande .= $lettres[rand(0, 25)];
        else
            $numero_commande .= rand(1, 9);
    }

    return $numero_commande;
}

function genererCleCommande()
{
    $lettres = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    $nbr_lettres = rand(0, 2);
    $cle_commande = '';

    if ($nbr_lettres == 0)
    {
        for ($i = 0; $i < 2; $i++)
        {
            $cle_commande .= rand(1, 9);
        }
    }
    else if ($nbr_lettres == 1)
    {
        $place_lettre = rand(0, 1);

        for ($i = 0; $i < 2; $i++)
        {
            if ($i == $place_lettre)
                $cle_commande .= $lettres[rand(0, 25)];
            else
                $cle_commande .= rand(1, 9);
        }
    }
    else
    {
        for ($i = 0; $i < 2; $i++)
        {
            $cle_commande .= $lettres[rand(0, 25)];
        }
    }

    return $cle_commande;
}