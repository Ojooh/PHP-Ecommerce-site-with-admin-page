<!-- Modal -->
<div class="modal fade " id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="sizesModalLabel">Size & Quantity</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="form-row">

                <?php for($i = 1;$i <= 12;$i++): ?>
                  <div class="form-group col-md-4">
                    <label for="size<?= $i; ?>">Size</label>
                    <input type="text" name="size<?= $i; ?>" id="size<?= $i; ?>" value="<?= ((!empty($sArray[$i-1]))?$sArray[$i-1]:''); ?>" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                    <label for="qty<?=$i;?>">Quantity</label>
                    <input type="number" name="qty<?= $i; ?>" id="qty<?= $i; ?>" value="<?= ((!empty($qArray[$i-1]))?$qArray[$i-1]:''); ?>" min="0" class="form-control">
                  </div>
              <?php endfor; ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Save changes</button>
      </div>
    </div>
  </div>
</div>
