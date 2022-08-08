<?php
$conn = mysqli_connect("localhost", "root", "", "pagination")
	or die("Error: " . mysqli_error($conn));
mysqli_query($conn, "SET NAMES 'utf8' ");

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1; //เลขหน้าที่แสดงข้อมูล
}

$record_show = 2; //จำนวนที่แสดง
$offset = ($page - 1) * $record_show; //เลขที่หรือลำดับเริ่มต้น

$s = "SELECT * FROM user";
$r = mysqli_query($conn, $s);
$row_total = mysqli_num_rows($r);
$page_total = ceil($row_total / $record_show); //จำนวนหน้าทั้งหมด
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"" rel=" nofollow">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div" rel="nofollow">
		<div style="height: 20px;"></div>
		<div class="row">
			<div class="col-lg-2">
			</div>
			<div class="col-lg-6">
				<h4>Simple Pagination using PHP/MySQLi</h4>
				<table width="80%" class="table table-striped table-bordered table-hover">

					<thead>
						<tr class="info">
							<th>UserID</th>
							<th>Firstname</th>
							<th>Lastname</th>
							<th>Username</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$ss = "SELECT * FROM user ORDER BY userid ASC LIMIT $offset,$record_show";
						$rr = mysqli_query($conn, $ss);
						while ($roww = mysqli_fetch_array($rr)) {
						?>
							<tr>
								<td><?php echo $roww['userid']; ?></td>
								<td><?php echo $roww['firstname']; ?></td>
								<td><?php echo $roww['lastname']; ?></td>
								<td><?php echo $roww['username']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="?page=1" aria-label="Previous">
								<span aria-hidden="true">First</span>
							</a>
						</li>
						<li class="page-item <?php echo $page > 1 ? '' : 'disabled' ?>">
							<a class="page-link" href="?page=<?= $page-1 ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						
						<?php for($i=1; $i <= $page_total; $i++): ?>
							<?php if ($page <= 2): ?>
								<!------------------------------------------->
								<?php if($i <= 5): ?>
									<li class="page-item <?=$page == $i ? 'active' : '' ?>"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
								<?php endif; ?>
								<!------------------------------------------->
								<?php elseif($page>2): ?>
								<?php if($i <= $page+2 && $i >= $page-2): ?>
									<li class="page-item <?=$page == $i ? 'active' : '' ?>"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
								<?php endif; ?>
								<!------------------------------------------->
							<?php endif; ?>
						<?php endfor; ?>
						
						<li class="page-item <?php echo $page < $page_total ? '' : 'disabled' ?>">
							<a class="page-link" href="?page=<?= $page+1?>" aria-label="Previous">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
						<li class="page-item <?php echo $page < $page_total ? '' : 'disabled' ?>">
							<a class="page-link" href="?page=<?php echo $page_total; ?>" aria-label="Next">
								<span aria-hidden="true">Last</span>
							</a>
						</li>
					</ul>
				</nav>

			</div>
			<div class="col-lg-2">
			</div>
		</div>
		</div>
</body>

</html>

<!-- Ref : 

	https://www.sourcecodester.com/tutorials/php/11606/simple-pagination-using-phpmysqli.html

	-->