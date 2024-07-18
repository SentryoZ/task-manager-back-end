<?php

namespace App\Const;

class ProjectConst
{
    // Owner have full permissions
    const PROJECT_ROLE_OWNER = 'owner';

    // Maintainer have top tier permissions, except which related to project like delete or rename, etc
    const PROJECT_ROLE_MAINTAINER = 'maintainer';

    // Have access to project issues
    const PROJECT_ROLE_DEVELOPER = 'developer';

    // Only have access to view project's document, issues and activities
    const PROJECT_ROLE_REPORT = 'report';

    // Only have access to view basic information of project like description and public documents
    const PROJECT_ROLE_GUEST = 'guest';

}
