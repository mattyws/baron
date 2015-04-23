<?php $today = new DateTime(); ?>
<section class="title">
    <h4><?php echo $module_details['name']; ?></h4>
</section>

<section class="item">

    <?php if ($members): ?>
        <table class="table-list">
            <thead>
                <tr>
                    <th></th>
                    <th width="20%"><?php echo lang('members:name'); ?></th>
                    <th width="200"><?php echo lang('members:rga'); ?></th>
                    <th width="200"><?php echo lang('members:payment'); ?></th>
                    <th width="200"><?php echo lang('members:nextPayment'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                    </td>
                </tr>
            </tfoot>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <?php $next = new DateTime($member->nextPayment); ?>
                    <tr>
                        <td><?php echo "<img src='$member->relative' width='80px' height='80px'></img>"; ?></td>
                        <td><?php echo $member->name; ?></td>
                        <td><?php echo $member->rga; ?></td>
                        <td <?php echo $today->diff($next)->d <= 5 ? 'style="color : red;"' : ''; ?>>
                            <?php echo $member->payment ? date("d/m/Y", strtotime($member->payment)) : lang('members:noPayment'); ?>
                        </td>
                        <td <?php echo $today->diff($next)->d <= 5 ? 'style="color : red;"' : ''; ?>>
                            <?php echo $member->nextPayment ? date("d/m/Y", strtotime($member->nextPayment)) : lang('members:noPayment'); ?>
                        </td>
                        <td class="actions">
                            <?php echo $today->diff($next)->d <= 5 ? anchor('admin/members/dopayment/' . $member->id, lang('members:doPayment'), 'class="button edit"') : ''; ?>
                            <?php echo anchor('admin/members/edit/' . $member->id, lang('global:edit'), 'class="button edit"'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <div class="no_data"><?php echo lang('members:no_members'); ?></div>
    <?php endif; ?>

</section>