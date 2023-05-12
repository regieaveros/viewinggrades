<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $title;?></h1>
                    <hr>
                    <?= validation_errors();?>
                </div>
            </div>
        </div>
    </div>
    <section class="content pb-3">
        <div class="container-fluid">
            <?= $form_edit;?>
            <div class="form-group">
                <label>Criteria Name:</label>
                <input 
                    class="form-control" 
                    type="text" 
                    name="criteria"
                    placeholder="Enter a criteria name"
                    value="<?= $criteria;?>" 
                />
            </div>
            <div class="form-group">
                <label>Percentage:</label>
                <input 
                    class="form-control" 
                    type="number"
                    name="percentage"
                    placeholder="Enter a percentage"
                    value="<?= $percentage;?>" 
                />
            </div>
            <div class="form-group">
                <label>Total Items:</label>
                <input 
                    class="form-control" 
                    type="number" 
                    name="total_items"
                    placeholder="Enter a total items"
                    value="<?= $total_items;?>"
                />
            </div>
            <div class="d-flex justify-content-between">
                <input type="hidden" name="id" value="<?= $id;?>" />
                <a href="<?= base_url()?>grade-criteria/<?= $slug_subject?>/<?= $subject_id?>" class="btn btn-primary text-uppercase font-weight-bold">
                    Go Back
                </a>
                <button class="btn btn-info text-uppercase font-weight-bold" type="submit">
                    <span class="d-none spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Update
                </button>
            </div>
        </div>
    </section>
</div>