<div style="height: {{size}}px; width: 100%;">
{% if mode == 'edit' %}
    <style>
    .edit-mode-arrow {
        margin: 0 auto 0;
        width: 10px;
    }
    .edit-mode-arrow-up {
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 6px 6px 6px;
        border-color: transparent transparent #007bff transparent;
    }
    .edit-mode-line {
        background: #007bff;
        margin: 0 0 0 4px;
        width: 4px;
    }
    .edit-mode-arrow-down {
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 6px 6px 0 6px;
        border-color: #007bff transparent transparent transparent;
    }
    </style>
    <div class="edit-mode-arrow">
        <div class="edit-mode-arrow-up"></div>
        <div class="edit-mode-line" style="height: {{size - 12}}px;"></div>
        <div class="edit-mode-arrow-down"></div>
    </div>
{% endif %}
</div>