<div class="row">
    <div class="col-sm-0 col-md-2"></div>
    <div class="col-sm-12 col-md-8 form-horizontal"> 
        <select name="ass_id" class="form-control" id="ass_id">
            <option>总统计</option>
    <?php
        foreach ($assignment_list as $key => $assignment) {
            $selected = '';
            if ($ass_id == $assignment['ass_id']) {
                $selected = 'selected';
            }
    ?>
            <option value="<?=$assignment['ass_id']?>" <?=$selected?> ><?='第'.($key + 1).'次'?></option>
    <?php
        }
    ?>
        </select>
    </div>
</div>
<div class="row form">    
    <div class="col-sm-0 col-md-2"></div>
    <div class="col-sm-12 col-md-8 form-horizontal" style="overflow-x: scroll; margin-top: 10px;"> 
    	<?php
    		if (count($assignment_list) > 0) {
        ?>
        <?php
        	   if (isset($statistics_data)) {
        ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
            	<tr>
            		<th>学号</th>
            		<th>姓名</th>
                    <th>本次得分</th>
                    <th>总次数</th>
            		<th>总得分</th>
            		<th>平均得分</th>
            		<th>名次</th>
            	</tr>
            </thead>
            <tbody>
        	<?php
        		  foreach ($statistics_data as $key => $record) {        			
        	?>
        		<tr>
        			<td><?=$record['s_serialNo']?></td>
        			<td>
        			<?php
	        			if (empty($record['total_point'])) {
	        		?>
	        			<a href="javascript:void(0);" class="noanswer"><?=$record['s_name']?></a>
	        		<?php
	        			}
	        			else {
	        		?>
	        			<a href="javascript:void(0)"><?=$record['s_name']?></a>
	        		<?php
	        			}
        			?>  
        			</td>
                    <td><?=$record['final_point']?></td>
                    <td><?=$record['assignment_times']?></td>
        			<td><?=$record['total_point']?></td>
        			<td>
        			<?php
                        if ($record['assignment_times'] > 0) {
                            echo round($record['total_point'] / $record['assignment_times'] , 2) ;
                        }
        			?>        				
        			</td>
        			<td><?=($key + 1)?></td>
        		</tr>
        	<?php
        		  }
        	?>
            </tbody>
        </table>
        <?php
        	   }
               else if(isset($statistics_assignmentdata)) {
        ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>得分</th>
                    <th>名次</th>
                </tr>
            </thead>
            <tbody>
            <?php
                  foreach ($statistics_assignmentdata as $key => $record) {                   
            ?>
                <tr>
                    <td><?=$record['s_serialNo']?></td>
                    <td>
                    <?php
                        if (empty($record['point'])) {
                    ?>
                        <a href="javascript:void(0);" class="noanswer"><?=$record['s_name']?></a>
                    <?php
                        }
                        else {
                    ?>
                        <a href="javascript:void(0)"><?=$record['s_name']?></a>
                    <?php
                        }
                    ?>  
                    </td>
                    <td><?=$record['point']?></td>
                    <td><?=($key + 1)?></td>
                </tr>
            <?php
                  }
            ?>
            </tbody>
        </table>
        <?php 
               }
    		}
    		else {
    			echo "<h4>没有资料.</h4>";
    		}
    	?>
    </div>
</div>   