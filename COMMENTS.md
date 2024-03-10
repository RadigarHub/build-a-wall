## Instructions for running the application

### Dev environment

Execute the following commands:

1. Make deps - To build docker container and install dependencies. IT MUST BE RUN FIRST ONE TIME.
2. Make build-a-wall ARGS="$1 $2" - To run the command to build a wall with the given arguments
   being [$1 = Number of rows] and [$2 = Number of bricks per row]

### Test environment

Execute the following commands:

1. Make deps - To build docker container and install dependencies. IT MUST BE RUN FIRST ONE TIME.
2. Make test/coverage - To test the application with code coverage.

## Design Considerations

I have developed the architecture of the application in a bounded-context and in three layers according to DDD, where
the inner layers cannot have knowledge of the outer layers.
The main bounded-context is Wall and inside it, we can find the three layers of the application:

### Infrastructure:

Is the external layer. This layer provides the concrete implementations needed to interact with the outside world, such
as databases, controllers, etc.

### Application:

Is the middle layer. This is where the domain objects are coordinated and managed to achieve the application use cases.

### Domain:

Is the internal layer. This is where the business rules are defined and represented. In this layer we can found
entities, valueObjects, interfaces and domain services.

## Use cases:

### Build a Wall:

In this use case, a wall is created with two value objects (WallNumberOfRows) and (WallNumberOfBricksPerRow) and a
response (BuildAWallResponse) containing a representation of the wall is returned.
