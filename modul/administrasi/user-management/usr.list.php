<?php

global $db;
// Important Variable
$page = $curpage; // <--- Get Current Page
$cur_page = $page;
$page -= 1;
$per_page = 10;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
$blegedes = "";
$addonwhere = "";
$tbl = "";
$total_string = "";
// Query The Transaction
$db->bind("page", $start);
// Additional WHERE
// Jika BUKAN Semua User
if (isset($_SESSION["filterusr"]["uname"]) && $_SESSION["filterusr"]["uname"] != "") {
    $db->bind("usrname", $_SESSION["filterusr"]["uname"]);
    $blegedes .= " uname = :usrname";
} else {
    $blegedes .= " uname <> 'a'";
}
if (isset($_SESSION["filterusr"]["date"]) && $_SESSION["filterusr"]["date"] != "") {
    $db->bind("tgl", $_SESSION["filterusr"]["date"]);
    $addonwhere .= " AND DATE(register_date) = :tgl";
}

//
$data = $db->query("SELECT * FROM user_id WHERE " . $blegedes . " " . $addonwhere . " AND role <> '0' ORDER BY uid DESC LIMIT 10 OFFSET :page"); // <-- Query with OFFSET
//
$tbl .='<div class="tblwrap">'
        . '<div id="loading">'
        . '<p>Retrieving Data From Server.....</p>'
        . '</div>'
        . '<table id="usr-tbl" class="footable table-bordered table-striped table-condensed" data-sort="false">';
$tbl .=' <thead>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>USERNAME</th>
                                                     <th data-hide="phone,tablet">REGISTER DATE</th>
                                                    <th data-hide="phone,tablet">UPLINE</th>
                                                    <th data-hide="phone,tablet">SPONSOR</th>
                                                    <th data-hide="phone,tablet">DETAILS</th>
                                                    <th data-hide="phone,tablet">MEMBERSHIP</th>
                                                    <th data-hide="phone,tablet">STATUS</th>
                                                    <th data-hide="phone,tablet">ACTION</th>
                                                </tr>
                                            </thead>
            <tbody id="usr-tbl-content">';
foreach ($data as $key => $value) {
    $data = get_data(get_parent($value['uid'], "int"), "uname");
    $sponsor = get_sponsor($value['uid'], "uname");
    $tbl .= "<tr>"
            . "<td>" . $value["uid"] . "</td>"
            . "<td>" . $value["uname"] . "</td>"
            . "<td>" . date('F d, Y', strtotime($value["register_date"])) . "</td>"
            . "<td>" . ($data=="0"?"ROOT":$data) . "</td>"
            . "<td>" . ($sponsor=="0"?"ROOT":$sponsor) . "</td>"
            . "<td>FIRST NAME <strong>" . getProfileData($value['uid'], 'first_name') . "</strong>"
            . "<br>LAST NAME <strong>" . getProfileData($value['uid'], 'last_name') . "</strong>"
            . "<br>EMAIL <strong>" . getProfileData($value['uid'], 'email') . "</strong>"
            . "<br>GENDER <strong>" . getProfileData($value['uid'], 'gender') . "</strong>"
            . "<br>PHONE <strong>" . getProfileData($value['uid'], 'phone') . "</strong>"
            . "<br>MOBILE <strong>" . getProfileData($value['uid'], 'mobile') . "</strong>"
            . "<br>FULL ADDRESS :<br> <strong>" . getProfileData($value['uid'], 'address') . "<br>" . getProfileData($value['uid'], 'city') . "," . getProfileData($value['uid'], 'zip') . "<br>" . getProfileData($value['uid'], 'state') . " - " . getProfileData($value['uid'], 'country') . "</strong>"
            . "</td>"
            . "<td>" . getProduct(get_data($value['uid'], "product"), "product_name") . "</td>"
            . "<td>" . ($value["banned"] != "1" ? "<span class='label label-success'>ITS OKAY!</span>" : "<span class='label label-danger'>BANNED</span>") . "</td>"
            . "<td>" . ($value["banned"] == "1" ? "<a class='btn btn-info unban' data-id='" . $value['uid'] . "'>UNBLOCK</a>" : "<a class='btn btn-danger ban' data-id='" . $value["uid"] . "'>BAN USER</a>")
            ."<br><br><a class='btn btn-success godmode' data-id='".$value["uid"]."'>LOGIN AS USER</a>"
            . "</td>"
            . "</tr>";
}

$tbl .='</tbody></table></div>';
/* --------------------------------------------- */
$blegedes = "";
$addonwhere = "";
// Jika BUKAN Semua User
if (isset($_SESSION["filterusr"]["uname"]) && $_SESSION["filterusr"]["uname"] != "") {
    $db->bind("usrname", $_SESSION["filterusr"]["uname"]);
    $blegedes .= " uname = :usrname";
} else {
    $blegedes .= " uname <> 'a'";
}
if (isset($_SESSION["filterusr"]["date"]) && $_SESSION["filterusr"]["date"] != "") {
    $db->bind("tgl", $_SESSION["filterusr"]["date"]);
    $addonwhere .= " AND DATE(register_date) = :tgl";
}

//$db->bind("uid",$_SESSION["uid"]);
$baris = $db->query("SELECT COUNT(uid) as jumlah FROM user_id WHERE " . $blegedes . " " . $addonwhere . " AND role <> '0'");
$count = $baris[0]["jumlah"];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$tbl .= "<div class='col-md-8'><ul class='pagination pagination-lg'>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $tbl .= "<li p='1' ><a>First</a></li>";
} else if ($first_btn) {
    $tbl .= "<li p='1' class='inactive'><a>First</a></li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $tbl .= "<li p='$pre' ><a>Previous</a></li>";
} else if ($previous_btn) {
    $tbl .= "<li class='inactive'><a>Previous</a></li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $tbl .= "<li p='$i' class='active'><a>{$i}</a></li>";
    else
        $tbl .= "<li p='$i'><a>{$i}</a></li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $tbl .= "<li p='$nex'><a>Next</a></li>";
} else if ($next_btn) {
    $tbl .= "<li class='inactive'><a>Next</a></li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $tbl .= "<li p='$no_of_paginations'><a>Last</a></li>";
} else if ($last_btn) {
    $tbl .= "<li p='$no_of_paginations' class='inactive'><a>Last</a></li>";
}
//$total_string = "<div class='col-md-4'><span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span></div>";
$tbl = $tbl . "</ul></div>" . $total_string;  // Content for pagination
echo $tbl;
