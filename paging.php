<?php /* title-search-paging-func.php */
$record_ppage = 2;
function compute_paging($search_kw) {
global $record_ppage;
$query = "SELECT count(*) FROM classics "

. "WHERE title LIKE '%$search_kw%'";

$result = $conn->query($query);
$row = $result->fetch_row();
$p_total = ceil($row[0]/$record_ppage);
$page = (isset($_REQUEST["page"]))? $_REQUEST["page"] : 1;
$start = ($page - 1) * $record_ppage;
$p_next = ($page > 1)? $page - 1 : 0;
$p_pre = ($page < $p_total)? $page + 1 : 0;
return array("p_total"=>$p_total, "p_no"=>$page,
"p_start"=>$start, "p_prev"=>$p_next,
"p_next"=>$p_pre, "total"=>$row[0]);

} //compute_paging()


function search($keyword) {
global $record_ppage;
$search_kw = str_replace(" ", "%' OR title LIKE '%", trim($keyword));
$paging = compute_paging($search_kw);
$query = "SELECT * FROM classics WHERE title LIKE '%$search_kw%'" .

. " LIMIT $paging[p_start], $record_ppage";

$result = $conn->query($query)
or die ("DB accessed failed: " . $conn->error);
while ($row = $result->fetch_assoc())
echo "<p><i>$row[title]</i>. $row[author] ($row[year]).";
if ($result->num_rows == 0)
echo "No title found";
return $paging;
} //search()

function page_nav_links($paging, $search_kw) {
echo "Page $paging[p_no]/$paging[p_total]:&nbsp&nbsp&nbsp";
if ($paging['p_prev'] > 0) { //previous
echo "<a href='title-search-paging.php?search_kw=$search_kw" .
"&page=" . $paging['p_prev'] ."'>Previous</a>&nbsp&nbsp&nbsp";
}
if ($paging['p_next'] > 0) { //next
echo "<a href='title-search-paging.php?search_kw=$search_kw " .
"&page=" . $paging['p_next'] ."'>Next</a>";
}
} //page_nav_links()
?>
