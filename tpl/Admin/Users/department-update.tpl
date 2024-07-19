<div>
	<div id="updateUserResults" class="alert alert-danger no-show validationSummary">
		<ul>
            {async_validator id="emailformat" key="ValidEmailRequired"}
            {async_validator id="uniqueemail" key="UniqueEmailRequired"}
            {async_validator id="uniqueusername" key="UniqueUsernameRequired"}
            {async_validator id="updateAttributeValidator" key=""}
		</ul>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addDepartmentId">{translate key="DepartmentId"}</label>
			<input type="text" {formname key="DEPARTMENT_ID"} class="form-control" disabled 
				   id="addDepartmentId" value="{$User->DepartmentId()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addDepartmentCode">{translate key="DepartmentCode"}</label>
			<input type="text" {formname key="DEPARTMENT_CODE"} class="form-control" 
					id="addDepartmentCode" value="{$User->DepartmentCode()|escape:html}"/>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addDepartmentname">{translate key="DepartmentName"}</label>
			<input type="text" {formname key="DEPARTMENT_NAME"} class="required form-control" required
				   id="addDepartmentname" value="{$User->DepartmentName()|escape:html}"/>
			<i class="glyphicon glyphicon-asterisk form-control-feedback"
			   data-bv-icon-for="addDepartmentname"></i>
		</div>
	</div>

	<div class="col-sm-12 col-md-6">
		<div class="form-group has-feedback">
			<label for="addGroup">{translate key="Group"}</label>
			{if $Groups|@count > 0}
				<select {formname key='GROUP_ID'} id='addGroup' class="form-control">
					<option value="">{translate key=None}</option>
					{html_options options=$Groups selected=$User->GroupId()}
				</select>
			{else}
				<select {formname key='GROUP_ID'} id='addGroup' class="form-control" disabled>
					<option value="">{translate key="NoDepartmentsAvailable"}</option>
				</select>
			{/if}
		</div>
	</div>
		<div class="clearfix">&nbsp;</div>
</div>
