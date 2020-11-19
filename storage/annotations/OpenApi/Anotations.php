<?php

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title=APP_NAME,
 * )
 */

/**
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *  )
 */

/**
 * @SWG\SecurityScheme(
 *      securityDefinition="default",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization"
 *  )
 */

/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Everything about authentication",
 * )
 *
 * @OA\Tag(
 *     name="Account",
 *     description="The apis of user account",
 * )
 */

/**
 * @OA\Post(
 * path="/login",
 * summary="Sign in",
 * description="Login by email, password",
 * operationId="authLogin",
 * tags={"Authentication"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="customer@demp.com"),
 *       @OA\Property(property="password", type="string", format="password", example="password"),
 *    ),
 * ),
 * @OA\Response(
 *    response=422,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(
 *             property="message",
 *             type="string",
 *             example="The given data was invalid."
 *       )
 *    )
 * )
 * )
 */

/**
 * @OA\Get(
 *      path="/projects/{id}",
 *      operationId="getProjectById",
 *      tags={"Projects"},
 *      summary="Get project information",
 *      description="Returns project data",
 *      @OA\Parameter(
 *          name="id",
 *          description="Project id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="successful operation"
 *       ),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=404, description="Resource Not Found"),
 *      security={
 *         {
 *             "oauth2_security_example": {"write:projects", "read:projects"}
 *         }
 *     },
 * )
 */