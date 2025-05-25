<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($currentProject['title']) ?>" required>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($currentProject['description']) ?></textarea>
</div>
<div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($currentProject['location']) ?>" required>
</div>
<div class="mb-3">
    <label for="start_day" class="form-label">Start Day</label>
    <input type="date" class="form-control" id="start_day" name="start_day" value="<?= htmlspecialchars($currentProject['start_day']) ?>" required>
</div>
<div class="mb-3">
    <label for="end_day" class="form-label">End Day</label>
    <input type="date" class="form-control" id="end_day" name="end_day" value="<?= htmlspecialchars($currentProject['end_day']) ?>" required>
</div>
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="planned" <?= $currentProject['status'] == 'planned' ? 'selected' : '' ?>>Planned</option>
        <option value="in progress" <?= $currentProject['status'] == 'in progress' ? 'selected' : '' ?>>In Progress</option>
        <option value="completed" <?= $currentProject['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
    </select>
</div>
<button type="submit" class="btn btn-primary">Update Project</button>
<a href="dashboard.php" class="btn btn-secondary">Cancel</a>

