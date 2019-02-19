<table id='resource_table' class='dataTable table-striped' style='width:840px'>
    <thead>
        <tr>
            <th><?php echo _("Name"); ?></th>
            <th><?php echo _("Title Count"); ?></th>
            <th><?php echo _("Content Type"); ?></th>
            <th><?php echo _("Imported?"); ?></th>
            <th><?php echo _("Current Holdings"); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($items as $item): ?>
        <?php $item->loadResource(); ?>
        <tr>
            <td>
                <?php echo $item->packageName; ?>
                <br>
                <small>(<?php echo $item->vendorName; ?>)</small> <a class="setPackage"
                                                                     data-vendor-id="<?php echo $item->vendorId; ?>"
                                                                     data-package-id="<?php echo $item->packageId; ?>"
                                                                     data-package-name="<?php echo $item->packageName; ?>"><?php echo _("view titles"); ?></a>
            </td>
            <td>
                <?php echo $item->titleCount; ?>
                <?php if($item->selectedCount != $item->titleCount): ?>
                <br>
                <small>(<?php echo $item->selectedCount.' '._('selected'); ?>)</small>
                <?php endif; ?>
            </td>
            <td>
                <?php echo $item->contentType; ?>
            </td>
            <td style="text-align: center;">
                <?php if($item->resource): ?>
                    <a href="resource.php?resourceID=<?php echo $item->resource->primaryKey; ?>">
                        <i class="fa fa-check text-success" title="<?php echo _('imported in Coral'); ?>"></i>
                    </a>
                <?php elseif ($item->selectedCount): ?>
                    <i class="fa fa-ban text-danger" title="Imported but not selected in EBSCO"></i>
                    <a href="ajax_forms.php?action=getEbscoKbPackageImportForm&height=700&width=730&modal=true&vendorId=<?php echo $item->vendorId; ?>&packageId=<?php echo $item->packageId; ?>"
                       class="thickbox">
                        <?php echo _('Import Package'); ?>
                    </a>
                <?php endif; ?>
            </td>
            <td style="text-align: center;">
                <?php if($item->selectedCount): ?>
                    <a href="#" class="btn btn-success">
                        <i class="fa fa-check"></i> <?php echo _('Selected'); ?> <i class="fa fa-chevron-down"></i>
                    </a>
                <?php else: ?>
                    <a href="#" class="btn">
                        <?php echo _('Not Selected'); ?> <i class="fa fa-chevron-down"></i>
                    </a>
                <?php endif; ?>

            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
