<?php add_thickbox(); ?>
<div class="settings" style="display: none;" id="form_content">
    <input class="field-id" type="hidden" name="field_id" value="">
    <table class="cs-contact-table">
        <tbody class="cs-contact-settings">
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-contact-name">Field Label</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" data-field="Field Label" name="cs-contact-label" id="cs-contact-label"
                            class="field-label field_required">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-contact-type">Field Type</label>
                </td>
                <td class="cs-contact-input">
                    <select data-field="Field Type" id="cs-contact-type" class="field-type field_required">
                        <option value="0" selected>Select Field Type</option>
                        <option value="text">Text</option>
                        <option value="textarea">Text Area</option>
                        <option value="number">Number</option>
                        <option value="email">Email</option>
                        <option value="tel">Tel</option>
                        <option value="url">Url</option>
                        <option value="selectbox">Select Box</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio</option>
                    </select>
                </td>
            </tr>
            <tr class="options">
                <td class="cs-contact-label">
                    <label for="cs-contact-options">Options</label>
                </td>
                <td class="cs-contact-input">
                    <div id="option-value">
                        <div id="option-list" class="option-field">
                            <fieldset>
                                <legend>Option List</legend>
                                <textarea name="option_list" rows="5" cols="20"
                                    placeholder="One option per line." class="option_list"></textarea>
                            </fieldset>
                        </div>
                        <div id="option-default" class="option-field">
                            <fieldset>
                                <legend>Option Default</legend>
                                <textarea name="option_default" rows="5" cols="20"
                                    placeholder="One option per line." class="option_default"></textarea>
                            </fieldset>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-contact-required">Required?</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-true-false">
                        <label class="switch">
                            <input type="checkbox" name="cs-contact-required" id="cs-contact-required" class="field-required">
                            <span class="slider"></span>
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-contact-minlength">Min Length</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="number" data-field="Min Length" name="cs-contact-minlength"
                            id="cs-contact-minlength" class="field-minlength">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-contact-minlength">Max Length</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="number" data-field="Max Length" name="cs-contact-maxlength"
                            id="cs-contact-maxlength" class="field-maxlength">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-contact-default_value">Default Value</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" data-field="Default Value" name="cs-contact-default_value"
                            id="cs-contact-default_value" class="field-default_value">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-contact-placeholder">Placeholder</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" data-field="Default Value" name="cs-contact-placeholder"
                            id="cs-contact-placeholder" class="field-placeholder">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label">
                    <label for="cs-contact-placeholder">Class For Field</label>
                </td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <input type="text" data-field="Default Value" name="cs-contact-class"
                            id="cs-contact-class" class="field-class">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cs-contact-label"></td>
                <td class="cs-contact-input">
                    <div class="cs-contact-input-wrap">
                        <a href="#" class="button btnSubmit">Save</a>
                    </div>
                </td>
            </tr>
            
        </tbody>
    </table>
    <div id="error-message"></div>
</div>