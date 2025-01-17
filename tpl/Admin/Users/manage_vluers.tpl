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
                <li role="presentation" class="divider"></li>
                <li role="presentation">
                    <a role="menuitem" href="#" id="add-user" class="add-link add-user">{translate key="AddStudent"}
                        <span class="fa fa-plus-circle add icon"></span>
                    </a>
                </li>

            </ul>
        </div>
        <h1>{translate key=ManageStudents}</h1>
    </div>

    <form id="filterForm" class="" role="form">
        <div class="form-group col-xs-4">
            <label for="userSearch">{translate key=FindStudent}
                | {html_link href=$smarty.server.SCRIPT_NAME key=AllStudents}</label>
            <input type="text" id="userSearch"
                   class="form-control"/>
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
            <th>{sort_column key=MSSV field=ColumnNames::STUDENT_ID}</th>
            <th>{sort_column key=FullName field=ColumnNames::FULL_NAME}</th>
            <th>{sort_column key=EnrollmentDate field=ColumnNames::STUDENT_ENROLLMENT_DATE}</th>
            <th>{sort_column key=StudentType field=ColumnNames::STUDENT_TYPE}</th>
            <th>{sort_column key=StudentStatus field=ColumnNames::STUDENT_STATUS}</th>
            <th>{sort_column key=DepartmentName field=ColumnNames::DEPARTMENT_NAME}</th>
            <th>{sort_column key=MajorName field=ColumnNames::STUDENT_MAJOR_NAME}</th>
            <th>{sort_column key=TrainingProgram field=ColumnNames::STUDENT_TRAINING_PROGRAM}</th>
            <th>{sort_column key=StudentClass field=ColumnNames::STUDENT_CLASS}</th>
            <th>{sort_column key=Email field=ColumnNames::EMAIL}</th>
            
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
                <td>{$user->MSSV}</td>
                <td>{$user->FullName}</td>
                <td>{$user->EnrollmentDate}</td>
                <td>{$user->StudentType}</td>
                <td>{$user->StudentStatus}</td>
                <td>{$user->DepartmentName}</td>
                <td>{$user->MajorName}</td>
                <td>{$user->TrainingProgram}</td>
                <td>{$user->StudentClass}</td>
                <td><a href="mailto:{$user->Email}">{$user->Email}</a></td>
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
		        {assign var=changeAttributeAction value=ManageUsersActions::ChangeAttribute}
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
              ajaxAction="{ManageVluersActions::AddStudent}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="addUserModalLabel">{translate key=AddStudent}</h4>
                    </div>
                    <div class="modal-body">
                        <div id="addUserResults" class="validationSummary alert alert-danger no-show">
                            <ul>
                                {async_validator id="addUserEmailformat" key="ValidEmailRequired"}
                                {async_validator id="addUserUniqueemail" key="UniqueEmailStudentRequired"}
                                {async_validator id="addUserStudentId" key="UniqueStudentIdRequired"}
                                {async_validator id="addAttributeValidator" key=""}
                            </ul>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addMSSV">{translate key="MSSV"}</label>
                                <input type="text" {formname key="MSSV"} class="required form-control" required
                                       id="addMSSV"/>
                                <i class="glyphicon glyphicon-asterisk form-control-feedback"
                                   data-bv-icon-for="addMSSV"></i>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addFullname">{translate key="FullName"}</label>
                                <input type="text" {formname key="FULLNAME"} class="required form-control" required
                                       id="addFullname"/>
                                <i class="glyphicon glyphicon-asterisk form-control-feedback"
                                   data-bv-icon-for="addFullname"></i>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addEmail">{translate key="Email"}</label>
                                <input type="text" {formname key="EMAIL"} class="required form-control" required
                                       id="addEmail"/>
                                <i class="glyphicon glyphicon-asterisk form-control-feedback"
                                   data-bv-icon-for="addEmail"></i>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addMajorname">{translate key="MajorName"}</label>
                                <input type="text" {formname key="MAJOR_NAME"} class="form-control"
                                        id="addMajorname"/>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addStudentclass">{translate key="StudentClass"}</label>
                                <input type="text" {formname key="STUDENT_CLASS"} class="form-control" 
                                       id="addStudentclass"/>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="addStudenttype">{translate key="StudentType"}</label>
                                <input type="text" {formname key="STUDENT_TYPE"} class="form-control" id="addStudenttype"/>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="addStatus">{translate key="StudentStatus"}</label>
                                <input type="text" {formname key="STUDENT_STATUS"} class="form-control"
                                       id="addStatus"/>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="addDate">{translate key="EnrollmentDate"}</label>
                                <input type="date" {formname key="ENROLLMENT_DATE"} class="form-control" id="addDate"/>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="addTrainingprogram">{translate key="TrainingProgram"}</label>
                                <input type="text" {formname key="TRAINING_PROGRAM"} class="form-control"
                                       id="addTrainingprogram"/>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group has-feedback">
                                <label for="addDepartment">{translate key="Department"}</label>
                                <select id="addDepartment" {formname key='DEPARTMENT_ID'} class="form-control">
                                    <option value="">{translate key=None}</option>
                                    {object_html_options options=$Departments label=Name key=Id}
                                </select>
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
              ajaxAction="{ManageUsersActions::ImportUsers}">
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
                                <label for="updateOnImport">{translate key=UpdateStudentsOnImport}</label>
                            </div>
                        </div>
                        <div id="importInstructions" class="alert alert-info">
                            <div class="note">{translate key=StudentImportInstructions}</div>
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

    <div id="permissionsDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="permissionsModalLabel"
         aria-hidden="true">
        <form id="permissionsForm" method="post" ajaxAction="{ManageUsersActions::Permissions}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="permissionsModalLabel">{translate key=Permissions}</h4>
                    </div>
                    <div class="modal-body scrollable-modal-content">
                        <div class="alert alert-warning">{translate key=UserPermissionInfo}</div>

                        <a href="#" id="checkNoResources">{translate key=None}</a> |
                        <a href="#" id="checkAllResourcesFull">{translate key=FullAccess}</a> |
                        <a href="#" id="checkAllResourcesView">{translate key=ViewOnly}</a>

                        {foreach from=$resources item=resource}
                            {cycle values='row0,row1' assign=rowCss}
                            {assign var=rid value=$resource->GetResourceId()}
                            <div class="{$rowCss} permissionRow form-group">
                                <label for="permission_{$rid}" class="inline-block">{$resource->GetName()}</label>
                                <select class="pull-right form-control input-sm resourceId inline-block"
                                        style="width:auto;" {formname key=RESOURCE_ID multi=true}
                                        id="permission_{$rid}">
                                    <option value="{$rid}_none" class="none">{translate key=None}</option>
                                    <option value="{$rid}_0" class="full">{translate key=FullAccess}</option>
                                    <option value="{$rid}_1" class="view">{translate key=ViewOnly}</option>
                                </select>
                                <div class="clearfix"></div>
                            </div>
                        {/foreach}
                    </div>
                    <div class="modal-footer">
                        {cancel_button}
                        {update_button}
                        {indicator}
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="passwordDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"
         aria-hidden="true">
        <form id="passwordForm" method="post" ajaxAction="{ManageUsersActions::Password}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="passwordModalLabel">{translate key=Password}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group has-feedback">
                            <label for="password">{translate key=Password}</label>
                            {textbox type="password" name="PASSWORD" class="required" value=""}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {cancel_button}
                        {update_button}
                        {indicator}
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="invitationDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="invitationModalLabel"
         aria-hidden="true">
        <form id="invitationForm" method="post" ajaxAction="{ManageUsersActions::InviteUsers}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="invitationModalLabel">{translate key=InviteUsers}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group has-feedback">
                            <label for="inviteEmails">{translate key=InviteUsersLabel}</label>
                            <textarea id="inviteEmails" class="form-control"
                                      rows="5" {formname key=INVITED_EMAILS}></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {cancel_button}
                        <button type="button" class="btn btn-success save"><span
                                    class="fa fa-send"></span> {translate key=InviteUsers}</button>
                        {indicator}
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="userDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
         aria-hidden="true">
        <form id="userForm" method="post" ajaxAction="{ManageVluersActions::UpdateStudent}">
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
                        {cancel_button}
                        {update_button}
                        {indicator}
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="deleteDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <form id="deleteUserForm" method="post" ajaxAction="{ManageVluersActions::DeleteStudent}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="deleteModalLabel">{translate key=Delete}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <div>{translate key=DeleteWarning}</div>

                            <div>{translate key=DeleteStudentWarning}</div>
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
        <form id="deleteMultipleUserForm" method="post" ajaxAction="{ManageVluersActions::DeleteMultipleStudents}">
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

                            <div>{translate key=DeleteMultipleStudentWarning}</div>
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

    <div id="groupsDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="groupsModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="groupsModalLabel">{translate key=Groups}</h4>
                </div>
                <div class="modal-body scrollable-modal-content">

                    <div id="groupList" class="hidden">
                        {foreach from=$Groups item=group}
                            <div class="group-item" groupId="{$group->Id}">
                                <a href="#"><span class="no-show">{$group->Name}</span>&nbsp;</a>
                                <span>{$group->Name}</span>
                            </div>
                        {/foreach}
                    </div>

                    <h5>{translate key=GroupMembership} <span class="badge" id="groupCount">0</span></h5>
                    <div id="addedGroups">
                    </div>

                    <h5>{translate key=AvailableGroups}</h5>
                    <div id="removedGroups">
                    </div>

                    <form id="addGroupForm" method="post" ajaxAction="addUser">
                        <input type="hidden" id="addGroupId" {formname key=GROUP_ID} />
                        <input type="hidden" id="addGroupUserId" {formname key=USER_ID} />
                    </form>

                    <form id="removeGroupForm" method="post" ajaxAction="removeUser">
                        <input type="hidden" id="removeGroupId" {formname key=GROUP_ID} />
                        <input type="hidden" id="removeGroupUserId" {formname key=USER_ID} />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="colorDialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="colorModalLabel"
         aria-hidden="true">
        <form id="colorForm" method="post" ajaxAction="{ManageUsersActions::ChangeColor}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="colorModalLabel">{translate key=Color}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="input-group">
                            <span class="input-group-addon">#</span>
                            <label for="reservationColor" class="no-show">Reservation Color</label>
                            <input type="text" {formname key=RESERVATION_COLOR} id="reservationColor" maxlength="6"
                                   class="form-control" placeholder="FFFFFF">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {cancel_button}
                        {update_button}
                        {indicator}
                    </div>
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
                url: updateUrl + '{ManageUsersActions::ChangeAttribute}', emptytext: '-'
            });

            $('.changeCredits').editable({
                url: updateUrl + '{ManageUsersActions::ChangeCredits}', emptytext: '-'
            });
        }

        $(document).ready(function () {
            var actions = {
                activate: '{ManageUsersActions::Activate}', deactivate: '{ManageUsersActions::Deactivate}'
            };

            var userOptions = {
                userAutocompleteUrl: "../ajax/studentautocomplete.php?type={StudentAutoCompleteType::MyStudents}",
                orgAutoCompleteUrl: "../ajax/studentautocomplete.php?type={StudentAutoCompleteType::Organization}",
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
                studentClass: '{$user->StudentClass|escape:"javascript"}',
                studentid: '{$user->MSSV|escape:"javascript"}',
                fullname: '{$user->FullName|escape:"javascript"}',
                enrollmentdate: '{$user->EnrollmentDate|escape:"javascript"}',
                studenttype: '{$user->StudentType|escape:"javascript"}',
                studentstatus: '{$user->StudentStatus|escape:"javascript"}',
                departmentname: '{$user->DepartmentName|escape:"javascript"}',
                majorname: '{$user->MajorName|escape:"javascript"}',
                trainingprogram: '{$user->TrainingProgram|escape:"javascript"}',
                studentClass: '{$user->StudentClass|escape:"javascript"}',
                email: '{$user->Email|escape:"javascript"}'
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
