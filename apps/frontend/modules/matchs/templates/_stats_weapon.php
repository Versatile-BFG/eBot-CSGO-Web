<h5><i class="icon-fire"></i> <?php echo __("Weapon Statistics by Player"); ?></h5>

<?php
	$players = array();
	$kills = PlayerKillTable::getInstance()->createQuery()->where("match_id = ?", $match->getId())->execute();
	$knives = array("knife_default_ct", "knife_flip", "knife_karambit", "knife_m9_bayonet", "knife_survival_bowie", "knife_t");
	foreach ($kills as $kill) {
		@$players[$kill->getKillerId()][$kill->getWeapon()]["k"]++;
		@$players[$kill->getKilledId()][$kill->getWeapon()]["d"]++;
		foreach ($knives as $knifes) {
			if (strcmp($kill->getWeapon(), $knifes) == 0) {
				@$players[$kill->getKillerId()]["knife"]["k"]++;
				@$players[$kill->getKilledId()]["knife"]["d"]++;
			}	
		}
	}
	
	$weapons = array("glock", "hkp2000", "usp_silencer", "usp_silencer_off", "p250", "cz75a", "elite", "fiveseven", "tec9", "deagle", "revolver", "mag7", "nova", "negev", "m249", "sawedoff", "xm1014", "mp9", "mac10", "mp7", "bizon", "p90", "ump45", "awp", "m4a1", "ak47", "famas", "galilar", "scar20","ssg08", "m4a1_silencer", "m4a1_silencer_off", "aug", "sg556", "g3sg1", "knife", "flashbang", "smokegrenade", "hegrenade", "inferno", "decoy", "taser");
	$pistols = array("glock", "hkp2000", "usp_silencer", "usp_silencer_off", "p250", "cz75a", "elite", "fiveseven", "tec9", "deagle", "revolver");
	$heavy = array("mag7", "nova", "negev", "m249", "sawedoff", "xm1014");
	$smg = array("mp9", "mac10", "mp7", "bizon", "p90", "ump45");
	$rifles = array("awp", "m4a1", "ak47", "famas", "galilar", "scar20","ssg08", "m4a1_silencer", "m4a1_silencer_off", "aug", "sg556", "g3sg1");
	$equipment = array("knife", "flashbang", "smokegrenade", "hegrenade", "inferno", "decoy", "taser");
?>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#stats-weapon-pistols"><?php echo __("Pistols"); ?></a></li>
    <li><a href="#stats-weapon-heavy"><?php echo __("Heavy"); ?></a></li>
    <li><a href="#stats-weapon-smg"><?php echo __("SMG"); ?></a></li>
    <li><a href="#stats-weapon-rifles"><?php echo __("Rifles"); ?></a></li>
    <li><a href="#stats-weapon-equipment"><?php echo __("Equipment"); ?></a></li>
</ul>

<div class="tab-pane" id="stats-weapon-pistols">
	<table class="table">
		<thead>
			<tr>
				<td rowspan="2"></td>
				<?php foreach ($pistols as $weapon): ?>
					<td style="border-left: 1px solid #DDDDDD; text-align: center; min-width: 50px;" colspan="2"><?php echo image_tag("/images/kills/csgo/" . $weapon . ".png", array("class" => "needTips_S", "title" => $weapon)); ?></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($pistols as $weapon): ?>
					<td style="border-left: 2px solid #DDDDDD;text-align: center;font-size: 10px; border-right: 1px solid #EEEEEE;">K</td>
					<td style="font-size: 10px; text-align: center;">D</td>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php $weaponsStats = array(); ?>
			<?php foreach ($match->getMap()->getPlayer() as $player): ?>
				<?php if ($player->getTeam() == "other") continue; ?>
				<tr>
					<td style="width: 150px; min-width: 150px;"><a href="<?php echo url_for("player_stats", array("id" => $player->getSteamid())); ?>"><?php echo $player->getPseudo(); ?></a></td>
					<?php foreach ($pistols as $weapon): ?>
						<td style="text-align: center;border-left: 2px solid #DDDDDD; border-right: 1px solid #EEEEEE;" <?php if (@$players[$player->getId()][$weapon]["k"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["k"] * 1; ?>
						</td>
						<td style="text-align: center;" <?php if (@$players[$player->getId()][$weapon]["d"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["d"] * 1; ?>
						</td>
						<?php @$weaponsStats[$weapon] += @$players[$player->getId()][$weapon]["k"] * 1; ?>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td>Total</td>
				<?php foreach ($pistols as $weapon): ?>
					<td <?php if ($weaponsStats[$weapon] * 1 == 0) echo 'class="muted" '; ?> style="border-left: 2px solid #DDDDDD; text-align: center;" colspan="2"><?php echo $weaponsStats[$weapon] * 1; ?></td>
				<?php endforeach; ?>
			</tr>
		</tfoot>
	</table>
</div>
<div class="tab-pane" id="stats-weapon-heavy">
	<table class="table">
		<thead>
			<tr>
				<td rowspan="2"></td>
				<?php foreach ($heavy as $weapon): ?>
					<td style="border-left: 1px solid #DDDDDD; text-align: center; min-width: 50px;" colspan="2"><?php echo image_tag("/images/kills/csgo/" . $weapon . ".png", array("class" => "needTips_S", "title" => $weapon)); ?></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($heavy as $weapon): ?>
					<td style="border-left: 2px solid #DDDDDD;text-align: center;font-size: 10px; border-right: 1px solid #EEEEEE;">K</td>
					<td style="font-size: 10px; text-align: center;">D</td>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php $weaponsStats = array(); ?>
			<?php foreach ($match->getMap()->getPlayer() as $player): ?>
				<?php if ($player->getTeam() == "other") continue; ?>
				<tr>
					<td style="width: 150px; min-width: 150px;"><a href="<?php echo url_for("player_stats", array("id" => $player->getSteamid())); ?>"><?php echo $player->getPseudo(); ?></a></td>
					<?php foreach ($heavy as $weapon): ?>
						<td style="text-align: center;border-left: 2px solid #DDDDDD; border-right: 1px solid #EEEEEE;" <?php if (@$players[$player->getId()][$weapon]["k"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["k"] * 1; ?>
						</td>
						<td style="text-align: center;" <?php if (@$players[$player->getId()][$weapon]["d"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["d"] * 1; ?>
						</td>
						<?php @$weaponsStats[$weapon] += @$players[$player->getId()][$weapon]["k"] * 1; ?>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td>Total</td>
				<?php foreach ($heavy as $weapon): ?>
					<td <?php if ($weaponsStats[$weapon] * 1 == 0) echo 'class="muted" '; ?> style="border-left: 2px solid #DDDDDD; text-align: center;" colspan="2"><?php echo $weaponsStats[$weapon] * 1; ?></td>
				<?php endforeach; ?>
			</tr>
		</tfoot>
	</table>
</div>
<div class="tab-pane" id="stats-weapon-smg">
	<table class="table">
		<thead>
			<tr>
				<td rowspan="2"></td>
				<?php foreach ($smg as $weapon): ?>
					<td style="border-left: 1px solid #DDDDDD; text-align: center; min-width: 50px;" colspan="2"><?php echo image_tag("/images/kills/csgo/" . $weapon . ".png", array("class" => "needTips_S", "title" => $weapon)); ?></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($smg as $weapon): ?>
					<td style="border-left: 2px solid #DDDDDD;text-align: center;font-size: 10px; border-right: 1px solid #EEEEEE;">K</td>
					<td style="font-size: 10px; text-align: center;">D</td>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php $weaponsStats = array(); ?>
			<?php foreach ($match->getMap()->getPlayer() as $player): ?>
				<?php if ($player->getTeam() == "other") continue; ?>
				<tr>
					<td style="width: 150px; min-width: 150px;"><a href="<?php echo url_for("player_stats", array("id" => $player->getSteamid())); ?>"><?php echo $player->getPseudo(); ?></a></td>
					<?php foreach ($smg as $weapon): ?>
						<td style="text-align: center;border-left: 2px solid #DDDDDD; border-right: 1px solid #EEEEEE;" <?php if (@$players[$player->getId()][$weapon]["k"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["k"] * 1; ?>
						</td>
						<td style="text-align: center;" <?php if (@$players[$player->getId()][$weapon]["d"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["d"] * 1; ?>
						</td>
						<?php @$weaponsStats[$weapon] += @$players[$player->getId()][$weapon]["k"] * 1; ?>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td>Total</td>
				<?php foreach ($smg as $weapon): ?>
					<td <?php if ($weaponsStats[$weapon] * 1 == 0) echo 'class="muted" '; ?> style="border-left: 2px solid #DDDDDD; text-align: center;" colspan="2"><?php echo $weaponsStats[$weapon] * 1; ?></td>
				<?php endforeach; ?>
			</tr>
		</tfoot>
	</table>
</div>
<div class="tab-pane" id="stats-weapon-rifles">
	<table class="table">
		<thead>
			<tr>
				<td rowspan="2"></td>
				<?php foreach ($rifles as $weapon): ?>
					<td style="border-left: 1px solid #DDDDDD; text-align: center; min-width: 50px;" colspan="2"><?php echo image_tag("/images/kills/csgo/" . $weapon . ".png", array("class" => "needTips_S", "title" => $weapon)); ?></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($rifles as $weapon): ?>
					<td style="border-left: 2px solid #DDDDDD;text-align: center;font-size: 10px; border-right: 1px solid #EEEEEE;">K</td>
					<td style="font-size: 10px; text-align: center;">D</td>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php $weaponsStats = array(); ?>
			<?php foreach ($match->getMap()->getPlayer() as $player): ?>
				<?php if ($player->getTeam() == "other") continue; ?>
				<tr>
					<td style="width: 150px; min-width: 150px;"><a href="<?php echo url_for("player_stats", array("id" => $player->getSteamid())); ?>"><?php echo $player->getPseudo(); ?></a></td>
					<?php foreach ($rifles as $weapon): ?>
						<td style="text-align: center;border-left: 2px solid #DDDDDD; border-right: 1px solid #EEEEEE;" <?php if (@$players[$player->getId()][$weapon]["k"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["k"] * 1; ?>
						</td>
						<td style="text-align: center;" <?php if (@$players[$player->getId()][$weapon]["d"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["d"] * 1; ?>
						</td>
						<?php @$weaponsStats[$weapon] += @$players[$player->getId()][$weapon]["k"] * 1; ?>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td>Total</td>
				<?php foreach ($rifles as $weapon): ?>
					<td <?php if ($weaponsStats[$weapon] * 1 == 0) echo 'class="muted" '; ?> style="border-left: 2px solid #DDDDDD; text-align: center;" colspan="2"><?php echo $weaponsStats[$weapon] * 1; ?></td>
				<?php endforeach; ?>
			</tr>
		</tfoot>
	</table>
</div>
<div class="tab-pane" id="stats-weapon-equipment">
	<table class="table">
		<thead>
			<tr>
				<td rowspan="2"></td>
				<?php foreach ($equipment as $weapon): ?>
					<td style="border-left: 1px solid #DDDDDD; text-align: center; min-width: 50px;" colspan="2"><?php echo image_tag("/images/kills/csgo/" . $weapon . ".png", array("class" => "needTips_S", "title" => $weapon)); ?></td>
				<?php endforeach; ?>
			</tr>
			<tr>
				<?php foreach ($equipment as $weapon): ?>
					<td style="border-left: 2px solid #DDDDDD;text-align: center;font-size: 10px; border-right: 1px solid #EEEEEE;">K</td>
					<td style="font-size: 10px; text-align: center;">D</td>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php $weaponsStats = array(); ?>
			<?php foreach ($match->getMap()->getPlayer() as $player): ?>
				<?php if ($player->getTeam() == "other") continue; ?>
				<tr>
					<td style="width: 150px; min-width: 150px;"><a href="<?php echo url_for("player_stats", array("id" => $player->getSteamid())); ?>"><?php echo $player->getPseudo(); ?></a></td>
					<?php foreach ($equipment as $weapon): ?>
						<td style="text-align: center;border-left: 2px solid #DDDDDD; border-right: 1px solid #EEEEEE;" <?php if (@$players[$player->getId()][$weapon]["k"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["k"] * 1; ?>
						</td>
						<td style="text-align: center;" <?php if (@$players[$player->getId()][$weapon]["d"] * 1 == 0) echo 'class="muted"'; ?>>
							<?php echo @$players[$player->getId()][$weapon]["d"] * 1; ?>
						</td>
						<?php @$weaponsStats[$weapon] += @$players[$player->getId()][$weapon]["k"] * 1; ?>
					<?php endforeach; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td>Total</td>
				<?php foreach ($equipment as $weapon): ?>
					<td <?php if ($weaponsStats[$weapon] * 1 == 0) echo 'class="muted" '; ?> style="border-left: 2px solid #DDDDDD; text-align: center;" colspan="2"><?php echo $weaponsStats[$weapon] * 1; ?></td>
				<?php endforeach; ?>
			</tr>
		</tfoot>
	</table>
</div>

<h5><i class="icon-info-sign"></i> <?php echo __("Info"); ?></h5>
<div class="well">
    <?php echo __("The column <b>K</b> represents the number of kill with this weapons, the column <b>D</b> represents the number of times the player has been killed by the weapon"); ?>
</div>