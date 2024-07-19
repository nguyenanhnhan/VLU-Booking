{include file='globalheader.tpl' InlineEdit=true cssFiles='scripts/css/colorpicker.css'}

<div id="page-manage-users" class="admin-page">

    <div>
        <div class="dropdown admin-header-more pull-right">
            <button class="btn btn-default" type="button" id="moreUserActions" data-toggle="dropdown">
                <span class="no-show">More</span>
                <span class="glyphicon glyphicon-option-horizontal"></span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="moreUserActions">
                <li role="presentation">
                    <a role="menuitem" href="#" id="import-users" class="add-link add-user">{translate key="Import"}
                        <span class="glyphicon glyphicon-import"></span>
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="{$ExportUrl}" download="{$ExportUrl}" id="export-users"
                       class="add-link add-user"
                       target="_blank">{translate key="Export"}
                        <span class="glyphicon glyphicon-export"></span>
                    </a>
                </li>
                <li role="presentation" class="divider"></li>
                <li role="presentation">
                    <a role="menuitem" href="#" id="add-user" class="add-link add-user">{translate key="AddDepartment"}
                        <span class="fa fa-plus-circle add icon"></span>
                    </a>
                </li>

            </ul>
        </div>
        <h1>{translate key=ManageDepartments}</h1>
    </div>

    <form id="filterForm" class="" role="form">
        <div class="form-group col-xs-4">
            <label for="userSearch">{translate key=FindDepartment}
                | {html_link href=$smarty.server.SCRIPT_NAME key=AllDepartments}</label>
            <input type="text" id="userSearch"
                   class="form-control"/>
        </div>
        <div class="form-group col-xs-2">
            <label for="filterStatusId">{translate key=Status}</label>
            <select id="filterStatusId" class="form-control">
                {html_options selected=$FilterStatusId options=$statusDescriptions}
            </select>
        </div>
        <div class="col-xs-6">
            &nbsp;
        </div>
        <div class="clearfix"></div>
    </form>

    {assign var=colCount value=11}
    <table class="table admin-panel" id="userList">
        <thead>
        <tr>
            <th>{sort_column key=DepartmentId field=ColumnNames::DEPARTMENT_ID}</th>
            <th>{sort_column key=DepartmentCode field=ColumnNames::DEPARTMENT_CODE}</th>
            <th>{sort_column key=DepartmentName field=ColumnNames::DEPARTMENT_NAME}</th>
            <th>{sort_column key=GroupName field=ColumnNames::GROUP_NAME}</th>
            
            <th>{translate key='Actions'}</th>
            <th class="action-delete">
                <div class="checkbox checkbox-single">
                    <input type="checkbox" id="delete-all" aria-label="{translate key=All}" title="{translate key=All}"/>
                    <label for="delete-all"></label>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$users item=user}
            {cycle values='row0,row1' assign=rowCss}
            {assign var=id value=$user->Id}
            <tr class="{$rowCss}" data-userId="{$id}">
                <td>{$user->DepartmentId}</td>
                <td>{$user->DepartmentCode}</td>
                <td>{$user->DepartmentName}</td>
                <td>{$user->GroupName}</td>
                {if $CreditsEnabled}
                    <td class="align-right">
						<span class="propertyValue inlineUpdate changeCredits"
                              data-type="number" data-pk="{$id}" data-value="{$user->CurrentCreditCount}"
                              data-name="{FormKeys::CREDITS}">{$user->CurrentCreditCount}</span>
                        <a href="credit_log.php?{QueryStringKeys::USER_ID}={$id}" title="{translate key=CreditHistory}">
                            <span class="no-color">{translate key=CreditHistory}</span>
                            <span class="fa fa-list"></span>
                        </a>
                    </td>
                {/if}
                {if $PerUserColors}
                    <td class="action">
                        <a href="#" class="update changeColor">{translate key='Edit'}</a>
                        {if !empty($user->ReservationColor)}
                            <div class="user-color update changeColor"
                                 style="background-color:#{$user->ReservationColor}">&nbsp;
                            </div>
                        {/if}
                    </td>
                {/if}

                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-default update edit">
                            <span class="no-show">{translate key=Update}</span>
                            <span class="fa fa-pencil-square-o"></button>
                        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">{translate key=More}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li role="presentation"><a role="menuitem"
                                                       href="#" class="update edit">{translate key="Edit"}</a>
                            </li>

                        </ul>
                    </div>
                    |
                    <div class="inline">
                        <a href="#" class="update delete">
                            <span class="no-show">{translate key=Delete}</span>
                            <span class="fa fa-trash icon remove"></span>
                        </a>
                    </div>
                </td>
                <td class="action-delete">
                    <div class="checkbox checkbox-single">
                        <input {formname key=USER_ID multi=true} class="delete-multiple" type="checkbox"
                                                                 id="delete{$id}" value="{$id}"
                                                                 aria-label="{translate key=Delete}" title="{translate key=Delete}"/>
                        <label for="delete{$id}" class=""></label>
                    </div>
                </td>
            </tr>
            {assign var=attributes value=$AttributeList}
            {if $attributes|default:array()|count > 0}
                <tr data-userId="{$id}">
                    <td colspan="{$colCount}" class="{$rowCss} customAttributes" userId="{$id}">
		        {assign var=changeAttributeAction value=ManageDepartmentsActions::ChangeAttribute}
		        {assign var=attributeUrl value="`$smarty.server.SCRIPT_NAME`?action=`$changeAttributeAction`"}
                        {foreach from=$AttributeList item=attribute}
                            {include file='Admin/InlineAttributeEdit.tpl' url=$attributeUrl id=$id attribute=$attribute value=$user->GetAttributeValue($attribute->Id())}
                        {/foreach}
                    </td>
                </tr>
            {/if}
        {/foreach}
        </tbody>
        <tfoot>
        <tr>
            <td colspan="{$colCount-1}"></td>
            <td class="action-delete">
                <a href="#" id="delete-selected" class="no-show" title="{translate key=Delete}">
                    <span class="no-show">{translate key=Delete}</span>
                    <span class="fa fa-trash icon remove"></span>
                </a>
            </td>
        </tr>
        </tfoot>
    </table>

    {pagination pageInfo=$PageInfo}

    <div id="addUserDialog" class="modal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
         aria-hidden="true">
        <form id="addUserForm" class="form" role="form" method="post"
              ajaxAction="{ManageDepartmentsActions::AddDepartment}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="addUserModalLabel">{translate key=AddDepartment}</h4>
                    </div>
                    <div class="modal-body">
                        <div id="addUserResults" class="validationSummary alert alert-danger no-show">
                            <ul>
                                {async_validator id="addUserEmailformat" key="ValidEmailRequired"}
                                {async_validator id="addUserUniqueemail" key="UniqueEmailRequired"}
                                {async_validator id="addUserUsername" key="UniqueUsernameRequired"}
                                {async_validator id="addAttributeValidator" key=""}
                            </ul>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addDepartmentId">{translate key="DepartmentId"}</label>
                                <input type="text" {formname key="DEPARTMENT_ID"} class="required form-control" required
                                       id="addDepartmentId"/>
                                <i class="glyphicon glyphicon-asterisk form-control-feedback"
                                   data-bv-icon-for="addDepartmentId"></i>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addDepartmentCode">{translate key="DepartmentCode"}</label>
                                <input type="text" {formname key="DEPARTMENT_CODE"} class="required form-control" required
                                       id="addDepartmentCode"/>
                                <i class="glyphicon glyphicon-asterisk form-control-feedback"
                                   data-bv-icon-for="addDepartmentCode"></i>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addDepartmentName">{translate key="DepartmentName"}</label>
                                <input type="text" {formname key="DEPARTMENT_NAME"} class="required form-control" required
                                       id="addDepartmentName"/>
                                <i class="glyphicon glyphicon-asterisk form-control-feedback"
                                   data-bv-icon-for="addDepartmentName"></i>
                            </div>
                        </div>
                        
                        {if $AttributeList|default:array()|count > 0}
                            <div class="col-xs-12 col-sm-6">
                                {control type="AttributeControl" attribute=$AttributeList[0]}
                            </div>
                        {else}
                            <div class="col-sm-12 col-md-6">&nbsp;</div>
                        {/if}

                        {if $AttributeList|default:array()|count > 1}
                            {for $i=1 to $AttributeList|default:array()|count-1}
                                {*{if $i%2==1}*}
                                {*<div class="row">*}
                                {*{/if}*}
                                <div class="col-xs-12 col-sm-6">
                                    {control type="AttributeControl" attribute=$AttributeList[$i]}
                                </div>
                                {*{if $i%2==0 || $i==$AttributeList|default:array()|count-1}*}
                                {*</div>*}
                                {*{/if}*}
                            {/for}
                        {/if}
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="checkbox inline">
                            <input type="checkbox" id="sendAddEmail"
                                   checked="checked" {formname key=SEND_AS_EMAIL} />
                            <label for="sendAddEmail">{translate key=NotifyUser}</label>
                        </div>
                        {cancel_button}
                        {add_button}
                        {indicator}
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="importUsersDialog" class="modal" tabindex="-1" role="dialog" aria-labelledby="importUsersModalLabel"
         aria-hidden="true">
        <form id="importUsersForm" class="form" role="form" method="post" enctype="multipart/form-data"
              ajaxAction="{ManageDepartmentsActions::ImportUsers}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="importUsersModalLabel">{translate key=Import}</h4>
                    </div>
                    <div class="modal-body">
                        <div id="importUserResults" class="validationSummary alert alert-danger no-show">
                            <ul>
                                {async_validator id="fileExtensionValidator" key=""}
                            </ul>
                        </div>
                        <div id="importErrors" class="alert alert-danger no-show"></div>
                        <div id="importResult" class="alert alert-success no-show">
                            <span>{translate key=RowsImported}</span>

                            <div id="importCount" class="inline bold">0</div>
                            <span>{translate key=RowsSkipped}</span>

                            <div id="importSkipped" class="inline bold">0</div>
                            <a class="" href="{$smarty.server.SCRIPT_NAME}">{translate key=Done}</a>
                        </div>
                        <div class="margin-bottom-25">
                            <input type="file" {formname key=USER_IMPORT_FILE} id="userImportFile"/>
                            <label for="userImportFile" class="no-show">User Import File</label>
                            <div class="checkbox">
                                <input type="checkbox" id="updateOnImport" {formname key=UPDATE_ON_IMPORT}/>
                                <label for="updateOnImport">{translate key=UpdateDepartmentsOnImport}</label>
                            </div>
                        </div>
                        <div id="importInstructions" class="alert alert-info">
                            <div class="note">{translate key=DepartmentImportInstructions}</div>
                            <a href="{$smarty.server.SCRIPT_NAME}?dr=template"
                               download="{$smarty.server.SCRIPT_NAME}?dr=template"
                               target="_blank">{translate key=GetTemplate} <span class="fa fa-download"></span></a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {cancel_button}
                        {add_button key=Import}
                        {indicator}
                    </div>
                </div>
            </div>
        </form>
    </div>

    <input type="hidden" id="activeId"/>

    <div id="userDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
         aria-hidden="true">
        <form id="userForm" method="post" ajaxAction="{ManageDepartmentsActions::UpdateDepartment}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="userModalLabel">{translate key=Edit}</h4>
                    </div>
                    <div class="modal-body">
                        <div id="update-user-placeholder"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="showConfirmationButton" class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span> {translate key=UpdateConfirmation}</button>
                        {cancel_button}
                        <div id="confirmationForm" class="no-show">

                                    <div class="modal-body">
                                        <div class="alert alert-warning">
                                            <div>{translate key=UpdateWarning}</div>
                                        </div>
                
                                    </div>

                            {update_button}
                        </div>
                        {indicator}
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="deleteDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <form id="deleteUserForm" method="post" ajaxAction="{ManageDepartmentsActions::DeleteDepartment}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="deleteModalLabel">{translate key=Delete}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <div>{translate key=DeleteWarning}</div>

                            <div>{translate key=DeleteDepartmentWarning}</div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        {cancel_button}
                        {delete_button}
                        {indicator}
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="deleteMultipleDialog" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="deleteMultipleModalLabel"
         aria-hidden="true">
        <form id="deleteMultipleUserForm" method="post" ajaxAction="{ManageDepartmentsActions::DeleteMultipleDepartments}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="deleteMultipleModalLabel">{translate key=Delete} (<span
                                    id="deleteMultipleCount"></span>)</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <div>{translate key=DeleteWarning}</div>

                            <div>{translate key=DeleteMultipleUserWarning}</div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        {cancel_button}
                        {delete_button}
                        {indicator}
                    </div>
                    <div id="deleteMultiplePlaceHolder" class="no-show"></div>
                </div>
            </div>
        </form>
    </div>

    {csrf_token}
    {include file="javascript-includes.tpl" InlineEdit=true}
    {jsfile src="ajax-helpers.js"}
    {jsfile src="autocomplete.js"}
    {jsfile src="admin/user.js"}
    {jsfile src="js/jquery.form-3.09.min.js"}
    {jsfile src="js/colorpicker.js"}

    <script type="text/javascript">
        function setUpEditables() {
            $.fn.editable.defaults.mode = 'popup';
            $.fn.editable.defaults.toggle = 'manual';
            $.fn.editable.defaults.emptyclass = '';
            $.fn.editable.defaults.params = function (params) {
                params.CSRF_TOKEN = $('#csrf_token').val();
                return params;
            };

            var updateUrl = '{$smarty.server.SCRIPT_NAME}?action=';
            $('.inlineAttribute').editable({
                url: updateUrl + '{ManageDepartmentsActions::ChangeAttribute}', emptytext: '-'
            });

            $('.changeCredits').editable({
                url: updateUrl + '{ManageDepartmentsActions::ChangeCredits}', emptytext: '-'
            });
        }

        $(document).ready(function () {
            var actions = {
                activate: '{ManageDepartmentsActions::Activate}', deactivate: '{ManageDepartmentsActions::Deactivate}'
            };

            var userOptions = {
                userAutocompleteUrl: "../ajax/departmentautocomplete.php?type={DepartmentAutoCompleteType::MyDepartments}",
                orgAutoCompleteUrl: "../ajax/departmentautocomplete.php?type={DepartmentAutoCompleteType::Organization}",
                groupsUrl: '{$smarty.server.SCRIPT_NAME}',
                groupManagementUrl: '{$ManageGroupsUrl}',
                permissionsUrl: '{$smarty.server.SCRIPT_NAME}',
                submitUrl: '{$smarty.server.SCRIPT_NAME}',
                saveRedirect: '{$smarty.server.SCRIPT_NAME}',
                selectUserUrl: '{$smarty.server.SCRIPT_NAME}?uid=',
                filterUrl: '{$smarty.server.SCRIPT_NAME}?{QueryStringKeys::ACCOUNT_STATUS}=',
                actions: actions,
                manageReservationsUrl: '{$ManageReservationsUrl}',
            };

            var userManagement = new UserManagement(userOptions);
            userManagement.init();

            {foreach from=$users item=user}
            var user = {
                id: '{$user->Id|escape:"javascript"}',
                departmentid: '{$user->DepartmentId|escape:"javascript"}',
                departmentcode: '{$user->DepartmentCode|escape:"javascript"}',
                departmentname: '{$user->DepartmentName|escape:"javascript"}',
                groupname: '{$user->GroupName|escape:"javascript"}'
            };
            userManagement.addUser(user);
            {/foreach}

            $('#reservationColor').ColorPicker({
                onSubmit: function (hsb, hex, rgb, el) {
                    $(el).val(hex);
                    $(el).ColorPickerHide();
                }, onBeforeShow: function () {
                    $(this).ColorPickerSetColor(this.value);
                }
            });


            setUpEditables();
        });
    </script>
</div>
{include file='globalfooter.tpl'}
