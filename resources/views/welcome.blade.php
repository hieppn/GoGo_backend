<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO GO</title>
</head>
<body>
    Hi gogo
</body>
</html>
public createUser(req: Request, res: Response){
        const {name,
            telephone,
            mobile,
            email,
            password,
            dateOfBirth,
            companyName,
            companyRole,
            userType} = req.body;
        if(!(name && telephone && mobile && email && password && dateOfBirth && companyName  )){
            return failureResponse("All fill is required", null, res);
        }
        //@ts-ignore
        const byUser = req.user ;
        if(byUser.userType === 0){
            switch (byUser.companyRole) {
                case 5: break;
                case 4:
                    if(companyRole >= 3) return failureResponse("Access denied, you can't create", null, res);
                    break;
                default: 
                    return failureResponse("Access denied, you can't create", null, res);
                    break;
            }
        }
        const userParams: IUser = { 
            name,
            telephone,
            mobile,
            email,
            password: bcrypt.hashSync(password, 10),
            dateOfBirth,
            companyName,
            companyRole,
            userType,
            lastActivity: new Date(),
            modificationNotes: [{
                modifiedBy: byUser,
                modifiedOn: new Date(),
                modificationNote: 'Create new user',
            }]
        }
        this.userService.filterUser({email},(err: Error, user: IUser) =>{
            if(err){
                return mongoError(err, res);
            }
            if(user){
                if(user.deletedAt != undefined){
                    userParams._id = user._id;
                    userParams.deletedAt = undefined;
                    this.userService.updateUser(userParams, (err: Error, userData: IUser) =>{
                        if(err){
                            return mongoError(err, res);
                        }
                        return successResponse("Create user successful", userData, res);
                    })
                } else
                return failureResponse("Email is already used", null, res);
            } else
            this.userService.createUser(userParams, (err: Error, newUser: IUser) =>{
                if(err){
                    return mongoError(err, res);
                }
                return successResponse("Create user successful", newUser, res);
            })
        })

    }
