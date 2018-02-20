<?php
function tweet($message)
{
    require_once('codebird.php');
    \Codebird\Codebird::setConsumerKey("YOURKEY", "YOURSECRET");
    $cb = \Codebird\Codebird::getInstance();
    $cb->setToken("YOURTOKEN", "YOURTOKENSECRET");
    $params = [
        'status' => $message
    ];
    $reply = $cb->statuses_update($params);
    return "Tweeted: $message";
}

function solo_data($username)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    $solo = $response->stats->p2;//solos data
    $solo_wins = $solo->top1->valueInt;
    $solo_matches = $solo->matches->valueInt;
    $solo_kills = $solo->kills->valueInt;
    $solo_top5 = $solo->top5->valueInt;
    $solo_top10 = $solo->top10->valueInt;
    $array = array('wins' => $solo_wins, 'matches' => $solo_matches, 'kills' => $solo_kills, 'top5' => $solo_top5, 'top10' => $solo_top10);
    $array = json_encode($array);
    $fp = fopen("solo.json", "w");
    fwrite($fp, $array);
    fclose($fp);
    return json_encode($array);
}

function duos_data($username)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    $duos = $response->stats->p10;//duos data
    $duos_wins = $duos->top1->valueInt;
    $duos_matches = $duos->matches->valueInt;
    $duos_kills = $duos->kills->valueInt;
    $duos_top5 = $duos->top5->valueInt;
    $duos_top10 = $duos->top10->valueInt;
    $array = array('wins' => $duos_wins, 'matches' => $duos_matches, 'kills' => $duos_kills, 'top5' => $duos_top5, 'top10' => $duos_top10);
    $array = json_encode($array);
    $fp = fopen("duos.json", "w");
    fwrite($fp, $array);
    fclose($fp);
    return json_encode($array);
}

function squads_data($username)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    $squads = $response->stats->p9;//squads data
    $squads_wins = $squads->top1->valueInt;
    $squads_matches = $squads->matches->valueInt;
    $squads_kills = $squads->kills->valueInt;
    $squads_top5 = $squads->top5->valueInt;
    $squads_top10 = $squads->top10->valueInt;
    $array = array('wins' => $squads_wins, 'matches' => $squads_matches, 'kills' => $squads_kills, 'top5' => $squads_top5, 'top10' => $squads_top10);
    $array = json_encode($array);
    $fp = fopen("squads.json", "w");
    fwrite($fp, $array);
    fclose($fp);
    return json_encode($array);
}

function ranking($username)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    $solo = $response->stats->p2;//solos data
    $duos = $response->stats->p10;//duos data
    $squads = $response->stats->p9;//squads data
    $solo_rank = $solo->score->rank;
    $duos_rank = $duos->score->rank;
    $squads_rank = $squads->score->rank;
    $array = array('soloRank' => $squads_wins, 'duosRank' => $squads_matches, 'squadsRank' => $squads_kills);
    $array = json_encode($array);
    $fp = fopen("rank.json", "w");
    fwrite($fp, $array);
    fclose($fp);
    return json_encode($array);
}

function compare($username, $i)
{
    $i = 0;
    switch ($i) {
        case 0://solo
            $data = json_decode(file_get_contents("solo.json"));
            $solo_wins = $data->wins;
            $solo_matches = $data->matches;
            $solo_kills = $data->kills;
            $solo_top5 = $data->top5;
            $solo_top10 = $data->top10;
            //compare to
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $solo = $response->stats->p2;//solos data
            $latest_solo_wins = $solo->top1->valueInt;
            $latest_solo_matches = $solo->matches->valueInt;
            $latest_solo_kills = $data->kills->valueInt;
            $latest_solo_top5 = $solo->top5->valueInt;
            $latest_solo_top10 = $solo->top10->valueInt;
            $kills_dif = ($latest_solo_kills - $solo_kills);
            if ($latest_solo_matches > $solo_matches) {
                if ($latest_solo_wins > $solo_wins) {
                    tweet("I just won a solo Fortnite Battle Royale game with $kills_dif kills!");
                    echo solo_data($username);
                    Return "Tweeted and updated";
                } elseif ($latest_solo_top5 > $solo_top5) {
                    tweet("I just finished top 5 in a solo Fortnite Battle Royale game with $kills_dif kills!");
                    echo solo_data($username);
                    Return "Tweeted and updated";
                } elseif ($latest_solo_top10 > $solo_top10) {
                    tweet("I just finished top 10 in a solo Fortnite Battle Royale game with $kills_dif kills!");
                    echo solo_data($username);
                    Return "Tweeted and updated";
                }
            } else {
                //do nothing
                //echo solo_data($username);
                //return "Updated";
            }
            break;
        case 1://duos
            $data = json_decode(file_get_contents("duos.json"));
            $duos_wins = $data->wins;
            $duos_matches = $data->matches;
            $duos_kills = $data->kills;
            $duos_top5 = $data->top5;
            $duos_top10 = $data->top10;
            //compare to
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $duos = $response->stats->p10;//solos data
            $latest_duos_wins = $duos->top1->valueInt;
            $latest_duos_matches = $duos->matches->valueInt;
            $latest_duos_kills = $data->kills->valueInt;
            $latest_duos_top5 = $duos->top5->valueInt;
            $latest_duos_top10 = $duos->top10->valueInt;
            $kills_dif = ($latest_duos_kills - $duos_kills);
            if ($latest_duos_matches > $duos_matches) {
                if ($latest_duos_wins > $duos_wins) {
                    tweet("I just won a duos Fortnite Battle Royale game with $kills_dif kills!");
                    echo duos_data($username);
                    Return "Tweeted and updated";
                } elseif ($latest_duos_top5 > $duos_top5) {
                    tweet("I just finished top 5 in a duos Fortnite Battle Royale game with $kills_dif kills!");
                    echo duos_data($username);
                    Return "Tweeted and updated";
                } elseif ($latest_duos_top10 > $duos_top10) {
                    tweet("I just finished top 10 in a duos Fortnite Battle Royale game with $kills_dif kills!");
                    echo duos_data($username);
                    Return "Tweeted and updated";
                }
            } else {
                //do nothing
                //echo duos_data($username);
                //return "Updated";
            }
            break;
        case 2://squads
            $data = json_decode(file_get_contents("squads.json"));
            $squads_wins = $data->wins;
            $squads_matches = $data->matches;
            $squads_kills = $data->kills;
            $squads_top5 = $data->top5;
            $squads_top10 = $data->top10;
            //compare to
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $squads = $response->stats->p9;//squads data
            $latest_squads_wins = $squads->top1->valueInt;
            $latest_squads_matches = $squads->matches->valueInt;
            $latest_squads_kills = $data->kills->valueInt;
            $latest_squads_top5 = $squads->top5->valueInt;
            $latest_squads_top10 = $squads->top10->valueInt;
            $kills_dif = ($latest_squads_kills - $squads_kills);
            if ($latest_squads_matches > $squads_matches) {
                if ($latest_squads_wins > $squads_wins) {
                    tweet("I just won a squads Fortnite Battle Royale game with $kills_dif kills!");
                    echo squads_data($username);
                    Return "Tweeted and updated";
                } elseif ($latest_squads_top5 > $squads_top5) {
                    tweet("I just finished top 5 in a squads Fortnite Battle Royale game with $kills_dif kills!");
                    echo squads_data($username);
                    Return "Tweeted and updated";
                } elseif ($latest_squads_top10 > $squads_top10) {
                    tweet("I just finished top 10 in a squads Fortnite Battle Royale game with $kills_dif kills!");
                    echo squads_data($username);
                    Return "Tweeted and updated";
                }
            } else {
                //do nothing
                //echo squads_data($username);
                //return "Updated";
            }
            break;
    }
}


function get_rank($username, $i)
{
    $i = 0;
    switch ($i) {
        case 0://solo
            $data = json_decode(file_get_contents("rank.json"));
            $solo_rank = $data->soloRank;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $solo = $response->stats->p2;//solos data
            $latest_solo_rank = $solo->score->rank;
            if ($latest_solo_rank < $solo_rank) {
                tweet("I just dropped my rank to $latest_solo_rank in solo's Fortnite Battle Royale!");
            } else {
                //do nothing
            }
            break;
        case 1://duos
            $data = json_decode(file_get_contents("rank.json"));
            $duos_rank = $data->duosRank;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $duos = $response->stats->p10;//duos data
            $latest_duos_rank = $duos->score->rank;
            if ($latest_duos_rank < $duos_rank) {
                tweet("I just dropped my rank to $latest_solo_rank in duo's Fortnite Battle Royale!");
            } else {
                //do nothing
            }
            break;
        case 2://squads
            $data = json_decode(file_get_contents("rank.json"));
            $squads_rank = $data->squadsRank;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.fortnitetracker.com/v1/profile/pc/" . $username . "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'TRN-Api-Key: *FORTNITE-TRACKER-API-KEY*'
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $squads = $response->stats->p9;//squads data
            $latest_squads_rank = $squads->score->rank;
            if ($latest_squads_rank < $squads_rank) {
                tweet("I just dropped my rank to $latest_squads_rank in squad's Fortnite Battle Royale!");
            } else {
                //do nothing
            }
            break;
    }
}
